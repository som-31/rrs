<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PassengerController extends Controller
{


    /**
     * Get Passenger bookings.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Passenger $passenger
     * @return \Illuminate\Http\Response
     */
    public function getPassengerBookings(Request $request, Passenger $passenger)
    {
        $result = $this->getTrainBookingsForFirstNLastName($request->get('firstname'),
            $request->get('lastname'));
        $passengers = json_decode(json_encode($result), true);
        return view('retrievePassengerBookings', [
            'passengers' => $passengers,
            'updatedRecord' => false
        ]);
    }

    /**
     * Get Bookings data for Firstname and lastname
     *
     * @param $firstname
     * @param $lastname
     * @return array
     */
    public function getTrainBookingsForFirstNLastName($firstname, $lastname)
    {
        return DB::select('Select t.train_number, t.name, p.first_name, p.last_name, b.status, b.category,
                                    b.booking_id, b.passenger_id, b.travel_date
                                    from train_info as t, bookings as b, passengers as p
                                    where t.train_number = b.train_number
                                    AND b.passenger_id = p.id
                                    AND p.first_name = ?
                                    AND p.last_name = ?',
            [$firstname, $lastname]);
    }

    /**
     * Get Bookings data for Firstname and lastname
     *
     * @param $firstname
     * @param $lastname
     * @return array
     */
    public function getTrainBookings()
    {
        return DB::select('Select t.train_number, t.name, p.first_name, p.last_name, b.status, b.category,
                                    b.booking_id, b.passenger_id, b.travel_date
                                    from train_info as t, bookings as b, passengers as p
                                    where t.train_number = b.train_number
                                    AND b.passenger_id = p.id order by b.travel_date');
    }


    /**
     * Get Passengers data for a specified date
     *
     * @param Request $request
     * @param Passenger $passenger
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getPassengersOnSpecifiedDate(Request $request, Passenger $passenger)
    {
        $result = DB::select('Select p.first_name,
                                           p.last_name,
                                           b.travel_date,
                                           b.status,
                                           DATE_FORMAT(b.travel_date, "%W") as day
                                    from passengers as p, bookings as b
                                    where p.id = b.passenger_id
                                    AND b.travel_date = ?',
            [$request->get('date')]);
        $passengers = json_decode(json_encode($result), true);
        return view('getPassengersOnSpecifiedDate', ['passengers' => $passengers]);
    }

    /**
     * Get Train information according to Age range
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getTrainInfoAccToAgeRange(Request $request)
    {
        $result = DB::select('Select t.train_number,
                                       t.name,
                                       t.source,
                                       t.destination,
                                       p.first_name,
                                       p.last_name,
                                       p.address,
                                       p.age,
                                       b.category,
                                       b.status
                                FROM train_info as t,
                                     passengers as p,
                                     bookings as b
                                Where t.train_number = b.train_number
                                AND p.id = b.passenger_id
                                AND p.age BETWEEN ? AND ?',
            [$request->get('minAge'), $request->get('maxAge')]);
        $result = json_decode(json_encode($result), true);
        return view('getTrainInfoByAge', ['result' => $result]);
    }

    /**
     * Get Passengers Count for train
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getPassengerCountForTrain(Request $request)
    {
        $result = DB::select('Select t.name, count(b.passenger_id) as passengers
                                    FROM train_info as t, bookings as b
                                    where t.train_number = b.train_number
                                    GROUP BY t.name');
        $result = json_decode(json_encode($result), true);
        return view('getCountOfPassengers', ['result' => $result]);
    }

    /**
     * Get Passenger information acc to train name
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getPassengersAccToTrainName(Request $request)
    {
        $result = DB::select('SELECT p.first_name,
                                       p.last_name,
                                       p.age,
                                       p.address,
                                       t.name ,
                                       b.status
                                From passengers as p,
                                bookings as b,
                                train_info as t
                                WHERE p.id = b.passenger_id AND
                                b.train_number = t.train_number AND
                                b.status = "confirmed" AND
                                t.name = ?',
            [$request->get('trainName')]);
        $result = json_decode(json_encode($result), true);
        return view('getInfoByTrainName', ['result' => $result]);
    }

    /**
     * View for Passenger
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function deletePassengerView(){
        $passengers = $this->getTrainBookings();
        $passengers = json_decode(json_encode($passengers), true);
        return view('deletePassengerView', ['passengers' => $passengers]);
    }

    /**
     * Function to Delete Passenger Booking
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function deletePassengerBooking(Request $request){
        // delete the old record
        $result = DB::delete('DELETE FROM bookings where booking_id = ?
                             AND train_number = ? AND passenger_id = ? AND travel_date = ?'
            , [$request->get('booking_id'), $request->get('train_number'),
                $request->get('passenger_id'), $request->get('travel_date')]);
        // get The old Passenger's Data
        $oldUserData = $this->getTrainBookings();
        $passengersData = json_decode(json_encode($oldUserData), true);

        // Check if the record is deleted or not
        if ($result) {
            $waitlistedRecord = DB::select('SELECT * from bookings where status = "waitlisted"
                         AND train_number = ? AND travel_date = ?', [
                $request->get('train_number'), $request->get('travel_date')
            ]);
            $waitlistedRecord = json_decode(json_encode($waitlistedRecord), true);
            /**
             * check if there's no waitlisted record
             */
            if (count($waitlistedRecord) === 0) {
                return view('/retrievePassengerBookings', [
                    'passengers' => $passengersData
                ]);
            }
            /**
             * update query for booking table
             */
            $updatedRecord = DB::update('UPDATE bookings set status = "confirmed"
           where booking_id = ? AND train_number = ? AND travel_date = ?', [
                $waitlistedRecord[0]['booking_id'],
                $waitlistedRecord[0]['train_number'],
                $waitlistedRecord[0]['travel_date']
            ]);
            $updatedRecord = json_decode(json_encode($updatedRecord), true);
            print_r($passengersData);
            return view('/retrievePassengerBookings', [
                'passengers' => $passengersData,
                'updatedRecord' => ($updatedRecord) ? $waitlistedRecord[0] : false
            ]);
        } else {
            /**
             * return response when there is some error deleting the user
             */
            return view('/retrievePassengerBookings', [
                'passengers' => $passengersData,
                'message' => 'Error Deleting Booking for Passenger'
            ]);
        }
    }
}

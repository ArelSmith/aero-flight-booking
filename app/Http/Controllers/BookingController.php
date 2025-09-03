<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePassengerDetailRequest;
use App\Interfaces\FlightRepositoryInterface;
use App\Interfaces\TransactionRepositoryInterface;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    private FlightRepositoryInterface $flightRepository;
    private TransactionRepositoryInterface $transactionRepository;

    public function __construct(FlightRepositoryInterface $flightRepository, TransactionRepositoryInterface $transactionRepository)
    {
        $this->flightRepository = $flightRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function booking(Request $request, $flightNumber) {
        $this->transactionRepository->saveTransactionDataToSession($request->all());
        return redirect()->route('booking.chooseSeat', ['flightNumber' => $flightNumber]);
    }

    public function chooseSeat(Request $request, $flightNumber) {
        $transaction = $this->transactionRepository->getTransactionDataFromSession();
        $flight = $this->flightRepository->getFlightByFlightNumber($flightNumber);
        $tier = $flight->classes->find($transaction['flight_class_id']);

        return view('pages.booking.choose-seat', compact('flight', 'tier', 'transaction'));
    }

    public function confirmSeat(Request $request, $flightNumber) {
        $this->transactionRepository->saveTransactionDataToSession($request->all());

        return redirect()->route('booking.passengerDetails', ['flightNumber' => $flightNumber]);
    }

    public function passengerDetails(Request $request, $flightNumber) {
        $transaction = $this->transactionRepository->getTransactionDataFromSession();
        $flight = $this->flightRepository->getFlightByFlightNumber($flightNumber);
        $tier = $flight->classes->find($transaction['flight_class_id']);

        return view('pages.booking.passenger-details', compact('flight', 'tier', 'transaction'));
    }

    public function savePassengerDetails(StorePassengerDetailRequest $request, $flightNumber) {
        $this->transactionRepository->saveTransactionDataToSession($request->all());

        return redirect()->route('booking.checkout', ['flightNumber' => $flightNumber]);
    }

    public function checkout($flightNumber) {
        $transaction = $this->transactionRepository->getTransactionDataFromSession();
        $flight = $this->flightRepository->getFlightByFlightNumber($flightNumber);
        $tier = $flight->classes->find($transaction['flight_class_id']);

        return view('pages.booking.checkout', compact('flight', 'tier', 'transaction'));
    }

    public function payment(Request $request) {
        dd($request->all());
        $this->transactionRepository->saveTransactionDataToSession($request->all());

        $transaction = $this->transactionRepository->saveTransaction($this->transactionRepository->getTransactionDataFromSession());

        // process midtrans
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');

        $params = [
            'transaction_details' => [
                'order_id' => $transaction->code,
                'gross_amount' => $transaction->grandtotal,
            ]
        ];
        
        $paymentUrl = Snap::createTransaction($params)->redirect_url;

        return redirect($paymentUrl);
    }

    public function checkBooking() {
        return view('pages.booking.check-booking');
    }
}

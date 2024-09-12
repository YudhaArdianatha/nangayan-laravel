<?php

namespace App\Admin\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class BookingController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Booking';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Booking());

        $grid->column('id', __('Id'));
        $grid->column('user.name', __('User'));
        $grid->column('room.room_type', __('Room Type'));
        $grid->column('checkin_date', __('Checkin date'));
        $grid->column('checkout_date', __('Checkout date'));
        $grid->column('num_of_rooms', __('Number of rooms'));
        $grid->column('status', __('Status'));
        $grid->column('total_payment', __('Total payment'));


        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Booking::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User'))->as(function ($userId) {
            return optional(User::find($userId))->name;
        });
        $show->field('room_id', __('Room Type'))->as(function ($roomId) {
            return optional(Room::find($roomId))->room_type;
        });
        $show->field('slug', __('Slug'));
        $show->field('checkin_date', __('Checkin date'));
        $show->field('checkout_date', __('Checkout date'));
        $show->field('status', __('Status'));
        $show->field('num_of_rooms', __('Num of rooms'));
        $show->field('total_room_payment', __('Total room payment'));
        $show->field('total_service_payment', __('Total service payment'));
        $show->field('total_payment', __('Total payment'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Booking());

        $form->select('user_id', __('User id'))->options(User::pluck('name', 'id'))->rules('required');
        $form->select('room_id', __('Room id'))->options(Room::pluck('room_type', 'id'))->rules('required');

        $form->hasMany('bookingServices', __('Booking Services'), function (Form\NestedForm $form) {
            $form->select('service_id', __('Service Name'))->options(Service::pluck('service_name', 'id'))->rules('required');
            $form->number('quantity', __('Quantity'))->default(1)->rules('min:1|required');
        });

        $form->date('checkin_date', __('Checkin date'))->default(date('Y-m-d'))->rules('required');
        $form->date('checkout_date', __('Checkout date'))->default(date('Y-m-d'))->rules('required');
        $form->number('num_of_rooms', __('Num of rooms'))->default(1)->rules('min:1|required');
        $form->select('status', __('Status'))->default('Unpaid')->options(['Paid' => 'Paid', 'Unpaid' => 'Unpaid'])->rules('required');

        $form->display('total_room_payment', __('Total room payment'));
        $form->display('total_service_payment', __('Total service payment'));
        $form->display('total_payment', __('Total payment'));

        $form->saving(function (Form $form) {
            // Ambil data room
            $room = Room::find($form->room_id);
            $checkinDate = $form->checkin_date;
            $checkoutDate = $form->checkout_date;
            $numOfRooms = $form->num_of_rooms;
            $duration = Carbon::parse($checkinDate)->diffInDays(Carbon::parse($checkoutDate));
        
            // Hitung total pembayaran kamar
            $form->total_room_payment = $numOfRooms * $room->room_price * $duration;
        
            // Hitung total pembayaran layanan
            $totalServicePayment = 0;
        
            // Periksa jika ada bookingServices
            if (isset($form->bookingServices) && count($form->bookingServices) > 0) {
                foreach ($form->bookingServices as $service) {
                    // Periksa jika service_id valid
                    if (isset($service['service_id'])) {
                        $serviceModel = Service::find($service['service_id']);
                        if ($serviceModel) {
                            $totalServicePayment += $serviceModel->service_price * $service['quantity'];
                        }
                    } else {
                        Log::error('service_id not found in service data:', $service);
                    }
                }
            }
        
            $form->total_service_payment = $totalServicePayment;
        
            // Hitung total pembayaran keseluruhan
            $form->total_payment = $form->total_room_payment + $form->total_service_payment;
        
            // Atur slug
            $form->model()->slug = Str::slug($form->model()->room_id . time());
        });
        
    

        return $form;
    }
}

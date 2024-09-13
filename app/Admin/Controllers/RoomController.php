<?php

namespace App\Admin\Controllers;

use App\Models\Photo;
use App\Models\Room;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Str;


class RoomController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Room';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Room());

        $grid->column('id', __('Id'));
        $grid->column('room_type', __('Room type'));
        $grid->column('room_description', __('Room description'));
        $grid->column('room_price', __('Room price'))->display(function($price) {
            return 'Rp ' . number_format($price, 0, ',', '.');
        });
        $grid->column('total_rooms', __('Total rooms'));
        $grid->column('available_rooms', __('Available rooms'));

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
        $show = new Show(Room::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('room_type', __('Room type'));
        $show->field('room_description', __('Room description'));
        $show->field('room_price', __('Room price'));
        $show->field('total_rooms', __('Total rooms'));
        $show->field('available_rooms', __('Available rooms'));
        $show->field('slug', __('Slug'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        $show->photos('Photos', function ($photo) {
            $photo->resource('/admin/photos');
            $photo->photo_type(__('Photo Type'));
            $photo->photo_path(__('Photo Path'))->image();
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Room());

        $form->text('room_type', __('Room type'));
        $form->textarea('room_description', __('Room description'));
        $form->decimal('room_price', __('Room price'));
        $form->number('total_rooms', __('Total rooms'));


        $form->image('room_image', __('Room image'));
        $form->image('bathroom_image', __('Bathroom image'));
        $form->image('extra_image', __('Extra image'));

        $form->ignore([
            'room_image',
            'bathroom_image',
            'extra_image',
        ]);

        $form->saving(function (Form $form) {
            $form->model()->slug = Str::slug($form->model()->room_type);
            $form->model()->available_rooms = $form->model()->total_rooms;
        });

        $form->saved(function (Form $form) {
           $photos = [
            'room_image' => request()->file('room_image'),
            'bathroom_image' => request()->file('bathroom_image'),
            'extra_image' => request()->file('extra_image'),
           ]; 

           $room = $form->model();
           $roomSlug = $room->slug;

           foreach ($photos as $type => $photo){
                if ($photo){
                    $fileExtension = $photo->getClientOriginalExtension();
                    $fileName = "{$roomSlug}_{$type}.{$fileExtension}";
        
                    $path = $photo->storeAs('rooms_image', $fileName, 'public');
        
                    $existingPhoto = Photo::where('room_id', $room->id)->where('photo_type', $type)->first();
        
                    if($existingPhoto){
                        $existingPhoto->update([
                            'photo_path' => $path,
                            'slug' => Str::slug($fileName),
                        ]);
                    }else{
                        Photo::create([
                            'room_id' => $room->id,
                            'photo_type' => $type,
                            'photo_path' => $path,
                            'slug' => Str::slug($fileName),
                        ]);
                    }
                }
            };
        });

        return $form;
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Carousel;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Carousel::latest()->get();
        return view('admin.carousel.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.carousel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'image | required'
        ]);

        $image = $request->file('image');
        $height = Image::make($image)->height();
        $width = Image::make($image)->width();

        if ($width >= 1400 && $height >= 600) {
            $currentDate = Carbon::now()->toDateTimeLocalString();
            $imageName = 'carousel'.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            // Create carousel folder
            if (!Storage::disk('public')->exists('carousel')){
                Storage::disk('public')->makeDirectory('carousel/');
            }

            //  Resize image
            $carousel = Image::make($image)->resize(1400, 600)->save();

            //  put image in carousel folder
            Storage::disk('public')->put('carousel/' .$imageName, $carousel);
        } else {
            Toastr::info('Image size must be up to 1400 * 600', 'Info');
            return redirect()->back();
        }

        $carousel = new Carousel();

        if (isset($request->status)){
            $carousel->status = true;
        } else {
            $carousel->status = false;
        }

        $carousel->image = $imageName;
        $carousel->save();

        Toastr::success('Image create successfully', 'Success');
        return redirect()->route('admin.carousel.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function show(Carousel $carousel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function edit(Carousel $carousel)
    {
        return view('admin.carousel.edit', compact('carousel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carousel $carousel)
    {
        $image = $request->file('image');

        if (isset($image)){
            $height = Image::make($image)->height();
            $width = Image::make($image)->width();

            if ($width >= 1400 && $height >= 600) {
                $currentDate = Carbon::now()->toDateTimeLocalString();
                $imageName = 'carousel'.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

                // Create carousel folder
                if (!Storage::disk('public')->exists('carousel')){
                    Storage::disk('public')->makeDirectory('carousel/');
                }

                //  Delete Old image
                if (Storage::disk('public')->exists('carousel/' .$carousel->image)){
                    Storage::disk('public')->delete('carousel/' .$carousel->image);
                }

                //  Resize image
                $updateImg = Image::make($image)->resize(1400, 600)->save();

                //  put image in carousel folder
                Storage::disk('public')->put('carousel/' .$imageName, $updateImg);
            } else {
                Toastr::info('Image size must be up to 1400 * 600', 'Info');
                return redirect()->back();
            }

        } else {
            $imageName = $carousel->image;
        }


        $carousel->image = $imageName;

        if (isset($request->status)) {
            $carousel->status = true;
        } else {
            $carousel->status = false;
        }

        $carousel->update();

        Toastr::success('Image Updated Successfully', 'Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carousel $carousel)
    {
        if (Storage::disk('public')->exists('carousel/' .$carousel->image)){
            Storage::disk('public')->delete('carousel/' .$carousel->image);
        }

        $carousel->delete();
        Toastr::success('Image Deleted Successfully :)', 'Success');
        return redirect()->back();
    }
}

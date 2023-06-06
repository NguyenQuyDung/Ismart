<?php

namespace App\Http\Controllers;

use App\Gallerie;
use App\Gallery;
use App\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class GalleryController extends Controller
{
    //
    public function view($id)
    {
        $pro_id = $id;
        return view('admin.gallery.index', compact('pro_id'));
    }
    public function insert_gallery(Request $request, $pro_id)
    {
        $request->validate(
            [

                'upload' => 'required',
            ],
            [
                'required' => ' :attribute Không Được Để Trống !',
                'min' => ' :attribute Có Độ Dài ít Nhẩt :min Ký Tự !',
                'max' => ' :attribute Có Độ Dài Tối Đa :min Ký Tự !',
            ],
            [

                'upload' => 'Bạn chưa chọn ảnh cần thêm !',
            ]
        );
        $get_image = $request->file('file');
        if ($get_image) {
            foreach ($get_image as $image) {
                $get_name_image = $image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 99) . '.' . $image->getClientOriginalExtension();
                $n = $image->move('public/uploads', $new_image);
                $gallery = new Gallery();
                $gallery->name = $new_image;
                $gallery->images = $n;
                $gallery->product_id = $pro_id;
                $gallery->save();
            }
        }
        return redirect()->back()->with('status', 'Bạn Đã Thêm Thư Viện Hình Ảnh thành công !');
    }
    public function update_gallery_name(Request $request)
    {
        $gal_id = $request->gal_id;
        $gal_text = $request->gal_text;
        $gallery = Gallery::find($gal_id);
        $gallery->name = $gal_text;
        $gallery->save();
    }
    public function delete_gallery(Request $request)
    {
        $gal_id = $request->gal_id;
        $gallery = Gallery::find($gal_id);
        // unlink('public/uploads/' . $gallery->images);
        $gallery->delete();
    }
    public function update_gallery(Request $request){
        $get_image = $request->file('file');
        $gal_id = $request->gal_id;
        if ($get_image) {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                $n = $get_image->move('public/uploads', $new_image);
                $gallery = Gallery::find($gal_id);
                $gallery->delete();
                $gallery->images = $n;
                $gallery->save();
        }
    }
    public function select_gallery(Request $request)
    {
        $product_id =  $request->pro_id;
        $gallery = Gallery::where('product_id', $product_id)->get();
        $gallery_count = $gallery->count();
        $output = '  <form>
        ' . csrf_field() . '<table class="table table-hover">
                      <thead class="bg-info">
                        <tr>
                          <th scope="col">STT</th>
                          <th scope="col">Tên Hình Ảnh <span style="color:#fff; font-weight:bold;">(Tên file ảnh)</span></th>
                          <th scope="col">Hình Ảnh</th>
                          <th scope="col">Thời gian</th>
                          <th scope="col">Người Thêm</th>
                          <th scope="col">Tác Vụ</th>
                         </tr>
                      </thead>
                     <tbody>';
        if ($gallery_count > 0) {
            $i = 0;
            foreach ($gallery as $key => $gal) {
                $i++;
                $output .= '
                <tr>
                <th scope="row" style="line-height:100px;">' . $i . '</th>
                <td contenteditable class="edit_gal_name" data-gal_id="' . $gal->id . '">' . $gal->name . '</td>
                <td><img style="width:80px; height:80px;" class="img-thumbnail" src="' . url($gal->images) . '">
                   <input type="file" title="Cập Nhật Ảnh Gallery Mới !"
                    class="file_image" style="width:55%; height:50%;" 
                   data-gal_id="'.$gal->id.'" id="file-'.$gal->id.'" name="file" accept="image/*">
                </td>
                <td>' . $gal->updated_at . '</td>
                <td>Nguyễn Qúy Dũng</td>
                <td>
                <button type="button" title="Xóa Ảnh Gallery !" data-gal_id="' . $gal->id . '" class="btn btn-xs btn-danger delete-gallery">
                <i class="fa fa-trash"></i>
                </button>
                </td>
                </tr>
                </form>
                ';
            }
        } else {
            $output .= '
            <tr>
            <th solspan="4">Hiện Tại Chưa Có Hình Ảnh trong Thư Viện Gallery !</th>
            </tr>
            ';
        }
        $output .= '
         </tbody>
         </table>
         </form>
        ';
        echo $output;
    }
}

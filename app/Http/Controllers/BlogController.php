<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\admin;
use App\Models\categories;
use App\Models\blog;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    // show all list
    public function getTatCaChuyenMuc()
    {                                        // show chuyên mục
        $categories = categories::orderby('id', 'ASC')->get();
        return view('admin.tatcachuyenmuc', ['categories' => $categories]);
    }
    public function getTatCaBaiViet()                                           // show bài viết
    {
        $blog = blog::orderby('id')->get();
        return view('admin.tatcabaiviet', ['blog' => $blog]);
    }

    //delete single
    public function getXoaChuyenMuc($id)
    {                       //Xóa 1 chuyên mục
        $product_type = categories::find($id);
        $product_type->delete();
        Session::flash('success', 'Successfully deleted the category');
        return redirect()->back();
    }
    public function getXoaBaiViet($id)
    {                         // Xóa 1 bài viết
        $product_type = blog::find($id);
        $product_type->delete();
        Session::flash('success', 'Successfully deleted the post');
        return redirect()->back();
    }
    // SỬA BÀI VIẾT
    public function suaBaiViet($id)
    {
        $blogEdit = blog::find($id);
        return view('admin.suabaiviet', ['blogEdit' => $blogEdit]);
    }
    public function postSuaBaiViet(Request $request)
    {
        $blogEdit = blog::find($request->id);

        $blogEdit->blog_type = $request->type;
        $blogEdit->blog_name = $request->name;
        if (isset($request->avatar)) {
            $ext = pathinfo($request->avatar, PATHINFO_EXTENSION);
            $fileName = time() . '.' . $ext;
            $request->avatar->move('public/blog_img', $fileName);

            $blogEdit->blog_avatar = $fileName;
        }

        $blogEdit->blog_note = $request->note;
        $blogEdit->blog_content = $request->content;

        $blogEdit->save();
        Session::flash('success', 'Post edited successfully');
        return redirect()->back();
    }

    public function getThemBaiViet(){

        return view('admin.thembaiviet');
    }
    public function postThemBaiViet(Request $request){
        $blog = new blog;
        $blog->blog_type = $request->type;
        $blog->blog_name = $request->name;
        $slug = Str::of($request->name)->slug('-');
        $blog->blog_slug = $slug;
        if (isset($request->avatar)) {
            $ext = pathinfo($request->avatar, PATHINFO_EXTENSION);
            $fileName = time() . '.' . $ext;
            $request->avatar->move('public/blog_img', $fileName);
            $blog->blog_avatar = $fileName;
        }
        else{
            $fileName = 'blog_default.png';
            $blog->blog_avatar = $fileName;
        }
        $blog->blog_note = $request->note;
        $blog->blog_content = $request->content;
        $blog->save();
        Session::flash('success', 'Post added successfully');
        return redirect()->back();
    }

}

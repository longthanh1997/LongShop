<?php

namespace App\Http\Controllers;
use App\Models\admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AdminFileManagerController extends Controller
{

    public function getAdminManager(){
        if(Auth::guard('admin')->user()->level == 2){
        $admin = admin::where('level', 1)->get();
        return view('admin.adminmanager')->with('admin', $admin);
}
else{
return back();
}
    }
    public function postchangePasswordAdmin(Request $request){
     $this->validate($request, [
            'new_password' => 'required',
            'old_password' => 'required',
            're_password' => 'required|same:new_password',
          ],
          [
            're_password.same' => 'Password was wrong',
            'old_password.required' => 'You have not entered a old password',
            'new_password.required' => 'You have not entered a new password',
            're_password.required' => 'You have not entered password confirmation',
          ]
        );
        $admin = admin::find(Auth::guard('admin')->user()->id);
        if (Hash::check($request->old_password, $admin->password)) {
            $admin->password = bcrypt($request->new_password);
            $admin->save();

            Session::flash('success', 'You have successfully changed your password');
            return back();
        }
        Session::flash('error', 'The old password is incorrect');
            return back();

    }
    public function postCreateAccountAdmin(Request $request){
$this->validate($request, [

	        'name' => ['required', 'min:3', 'max:255', 'unique:users,name'],

	      ],
	      [
	        'name.unique' => 'The login name is already in use',
	      ]
	    );
        if (preg_match('/[óòỏõọôốồổỗộơớờởỡợÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢ@áàảãạăắặằẳẵâấầẩẫậÁÀẢÃẠĂẮẶẰẲẴÂẤẦẨẪẬđĐéèẻẽẹêếềểễệÉÈẺẼẸÊẾỀỂỄỆíìỉĩịÍÌỈĨỊúùủũụưứừửữựÚÙỦŨỤƯỨỪỬỮỰýỳỷỹỵÝỲỶỸỴ\'^£$%&*()}{!#~"?><>,|=.+¬-]/', $request->name) || strpos($request->name, ' '))
        {
            Session::flash('error', 'The login name cannot contain special characters');
            return back();
        }
        Admin::create(['name' => $request->name,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'level' => 1,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh')
        ]);
        Session::flash('success', 'Successfully created account!');
        return back();
    }
    public function getDeleteAccountAdmin($id){
        admin::find($id)->delete();
        Session::flash('success', 'Successfully deleted admin');
        return back();
    }

    public function showFileManager(){
    	return view('admin.filemanager');
    }
    public function postFileManager(){
    	$folder = array_filter(glob('public/upload/*'), 'is_dir');
    	$output = '<table class="table">
    		<tr>
    			<td>Link</td>
    			<td>Total file</td>
    			<td>update</td>
    			<td>delete</td>
    			<td>Upload file</td>
    			<td>View Upload file</td>
    		</tr>
    	';

    	if(count($folder) > 0){
    		foreach ($folder as $name) {
    			$output .= '<tr>
    				<td>'.$name.'</td>
    				<td>'.(count(scandir($name)) - 2).'</td>
    				<td><button data-name='.$name.' class="btn btn-primary">update</td>
    				<td><button data-name='.$name.' class="btn btn-danger">delete</td>
    				<td><button data-name='.$name.' class="btn btn-danger">Upload</td>
    				<td><button data-name='.$name.' class="btn btn-info">View</td>
    			</tr>';
    		}
    	}
    	else{
    		$output = '<tr>
    			<td colspan="6">No result</td>
    		</tr>';
    	}
    	return $output.'</table>';
    }

}

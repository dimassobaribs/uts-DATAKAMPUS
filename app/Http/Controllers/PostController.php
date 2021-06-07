<?php

namespace App\Http\Controllers;

use App\Models\data_mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $data_mahasiswas = data_mahasiswa::latest()->when(request()->search, function($data_mahasiswas) {
            $data_mahasiswas = $data_mahasiswas->where('nama', 'like', '%'. request()->search . '%');
        })->paginate(5);

        return view('post.index', compact('data_mahasiswas'));
    }
    /**
    * create
    *
    * @return void
    */
    public function create()
    {
      return view('post.create');
    } 
        
    /**
    * store
    *
    * @param  mixed $request
    * @return void
    */
    public function store(Request $request)
    {
      $this->validate($request, [
        'nama'     => 'required',
        'alamat'     => 'required',
        'kontak'   => 'required'
      ]);

      $post = data_mahasiswa::create([
          'nama'     => $request->nama,
          'alamat'     => $request->alamat,
          'kontak'   => $request->kontak
      ]);

      if($post){
        //redirect dengan pesan sukses
        return redirect()->route('post.index')->with(['success' => 'Data Berhasil Disimpan!']);
      }else{
        //redirect dengan pesan error
        return redirect()->route('post.index')->with(['error' => 'Data Gagal Disimpan!']);
      }

    }
      /**
* edit
*
* @param  mixed $post
* @return void
*/
public function edit(data_mahasiswa $post)
{
  return view('post.edit', compact('post'));
}
      
    /**
    * update
    *
    * @param  mixed $request
    * @param  mixed $post
    * @return void
    */
    public function update(Request $request, data_mahasiswa $post)
    {
      $this->validate($request, [
          'nama'     => 'required',
          'alamat' => 'required',
          'kontak'   => 'required'
      ]);
        
      //get data post by ID
      $post = data_mahasiswa::findOrFail($post->id);
        
      if($request->file('image') == "") {
        
        $post->update([
            'nama'     => $request->nama,
            'alamat'   => $request->alamat,
            'kontak' => $request->kontak
        ]);
        
      } else {
        
          //hapus old image
          Storage::disk('local')->delete('public/data_mahasiswas/'.$post->image);
        
          //upload new image
          $image = $request->file('image');
          $image->storeAs('public/data_mahasiswas', $image->hashName());
        
          $post->update([
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'content'   => $request->content
          ]);
        
      }
        
      if($post){
        //redirect dengan pesan sukses
        return redirect()->route('post.index')->with(['success' => 'Data Berhasil Diupdate!']);
      }else{
        //redirect dengan pesan error
        return redirect()->route('post.index')->with(['error' => 'Data Gagal Diupdate!']);
      }
    }
    /**
    * destroy
    *
    * @param  mixed $id
    * @return void
    */
    public function destroy($id)
    {
    $post = data_mahasiswa::findOrFail($id);
    Storage::disk('local')->delete('public/data_mahasiswas/'.$post->image);
    $post->delete();

    if($post){
    //redirect dengan pesan sukses
    return redirect()->route('post.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }else{
    //redirect dengan pesan error
    return redirect()->route('post.index')->with(['error' => 'Data Gagal Dihapus!']);
    }
  }
}

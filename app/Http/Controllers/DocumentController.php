<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentController extends Controller
{
    //

    private $folder = null;

    public function showAll() {

        $files = [
            "deu" => $this->getDocumentsFromFolder("deu"),
            "other" => $this->getDocumentsFromFolder("other")
        ];

        return view('documents')->with('files', $files);
    }

    private function getDocumentsFromFolder($fld) {
        $files = \Storage::files("/public/{$fld}/docs");

        $files = array_map(function($o) use($fld) {
            return str_replace(".pdf", "", explode("public/{$fld}/docs/", $o)[1]);
        }, $files);

        return $files;
    }

    public function findDocumentTOC($name) {
        $fname = explode(".", $name)[0];
        $fname_json = $fname.".json";
        $full_path_json = "public/{$this->folder}/toc/".$fname_json;

        $table_of_contents_files = \Storage::files("/public/{$this->folder}/toc");

        //dd($full_path_json);
        //dd($table_of_contents_files);

        if(!in_array($full_path_json, $table_of_contents_files)) {
            return (object)array();
        }

        $json_content = json_decode(file_get_contents(storage_path("app/".$full_path_json)));

        return $json_content;
    }

    public function showDocument($folder, $index) {
        $index .= ".pdf";
        //sanitize
        $this->folder = filter_var($folder, FILTER_SANITIZE_STRING);
        //If still not safe then just ditch
        if (!preg_match('/[^A-Za-z0-9]/', $this->folder)) redirect('/documents');

        $files = \Storage::files("/public/{$this->folder}/docs");
        $files_array = array();
        foreach($files as $i => $o) {
            $asset_name = explode("public/{$this->folder}/docs/", $o)[1];
            $files_array[$asset_name] = array("path" => asset("storage/{$this->folder}/docs/".$asset_name), "name" => $asset_name);
        } 
        //dd($files_array[$index]);

        //dd(var_dump(!isset($files_array[$index])));

        if(!isset($files_array[$index])) {
            return redirect('/documents');
        }

        $file = $files_array[$index];
        
        $toc = $this->findDocumentTOC($file['name']);
        $file['contents'] = $toc;

        return view('document')->with('file', $file);

    }

    public function getPath($id) {
        $files = array_map(function($o) {
            return explode("docs/", $o)[1];
        }, $files);
        $url = config("app.url")."/storage/app/docs/".$files[$id];
        return response()->file($url);
    }
}

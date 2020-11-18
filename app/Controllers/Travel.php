<?php
namespace App\Controllers;

class Travel extends BaseController {

    public function index() {
        $parser = \Config\Services::parser();  
        $places = new \App\Models\Places(); 
        $table = new \CodeIgniter\View\Table();
        $headings = $places->fields;
        $displayHeadings = array($headings[1], $headings[7], $headings[6]);
        $table->setHeading(array_map('ucfirst', $displayHeadings));
            $records = $places->findAll(); 
        foreach ($records as $record) {
        $nameLink = anchor("travel/showme/$record->id",$record->name);
        $image='<img src="/image/.'.'image">';
        $table->addRow($nameLink,$image,$record->description);
       // $table->addRow($record->name,$record->description);
        }
        $template = [
        'table_open' => '<table cellpadding="5px">',
        'cell_start' => '<td style="border: 1px solid #dddddd;">',
        'row_alt_start' => '<tr style="background-color:#dddddd">',
        ];
        $table->setTemplate($template);
        $fields = [
        'title' => 'Travel Destinations',
        'heading' => 'Travel Destinations',
        'footer' => 'Copyright Xavier'
        ];
        // connect to the model     
        // retrieve all the records    
        // get a template parser    
        $parser = \Config\Services::parser();  
        // tell it about the substitions   
      return $parser->setData($fields)
        ->render('templates\top') .
        $table->generate() .
        $parser->setData($fields)
        ->render('templates\bottom');
    }
    public function showme($id)   
     {   
        // connect to the model  
        $places = new \App\Models\Places();  
        // retrieve all the records   
        $record = $places->find($id);   
        // get a template parser    
        $parser = \Config\Services::parser();   
        // tell it about the substitions   
        return $parser->setData($record)   
        // and have it render the template with those      
        ->render('oneplace');
     } 
}

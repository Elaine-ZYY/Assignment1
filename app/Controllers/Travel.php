<?php

namespace App\Controllers;

class Travel extends BaseController {

    public function index() {
        $parser = \Config\Services::parser();
        $places = new \App\Models\Places();
        $table = new \CodeIgniter\View\Table();
        $headings = $places->fields;
        $displayHeadings = array($headings[1], $headings[7]);
        $table->setHeading(array_map('ucfirst', $displayHeadings));
        $records = $places->findAll();
        foreach ($records as $record) {
            $nameLink = anchor("travel/showme/$record->id", $record->name);
            $image = '<img src="/image/' . $record->image . '">';
            $table->addRow($nameLink, $image);
            // $table->addRow($record->name,$record->description);
        }
        $template = [
            'table_open' => '<table cellpadding="5px">',
            'cell_start' => '<td style="border: 1px solid #dddddd;">',
            'row_alt_start' => '<tr style="background-color:#dddddd">',
        ];
        $table->setTemplate($template);
        $fields = [
            'title' => 'Rock Singer',
            'heading' => 'Rock Singer',
            'footer' => 'Copyright ZYY'
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

    public function showme($id) {
        // connect to the model  
        $places =new \App\Models\Places();
        // retrieve all the records   
        $record = $places->find($id);
        
        $table = new \CodeIgniter\View\Table();
        
        
           $table->addRow($record['id']);
           $table->addRow($record['name']);
           $table->addRow($record['birth']);
           $table->addRow($record['place']);
           $table->addRow($record['description']);
           $table->addRow($record['magnum opus']);
           $table->addRow($record['link']);
            $image = '<img src="/image/' . $record['image'] .'">';
            $table->addRow($image);
            
        $template = [
            'table_open' => '<table cellpadding="5px">',
            'cell_start' => '<td style="border: 1px solid #dddddd;">',
            'row_alt_start' => '<tr style="background-color:#dddddd">',
        ];
        $table->setTemplate($template);
        $fields = [
            'title' => 'Rock Singer',
            'heading' => 'Rock Singer',
            'footer' => 'Copyright ZYY'
        ];
        $parser = \Config\Services::parser();
        // tell it about the substitions   
        return $parser->setData($fields)
                        ->render('templates\top') .
                $table->generate() .
                        $parser->setData($fields)
                        ->render('templates\bottom');
    
        // get a template parser    
        $parser = \Config\Services::parser();
        // tell it about the substitions   
        return $parser->setData($record)
                        // and have it render the template with those      
                        ->render('oneplace');
    }
   

}

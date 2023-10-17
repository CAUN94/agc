<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CustomMessage extends Component
{
    public $tags = '';
    public $message = 'Hola [NombreCompleto]';
    public $generatedMessage = '';
    protected $listeners = ['messageUpdated'];
    public $newTag = '';
    public $tagValue = '';
    public $tagsArray = ['NombreCompleto' => 'Nombre y Apellido','Celular' => '+56933809726'];
    public $editTag = null;
    

    public function render()
    {
        return view('livewire.custom-message', [
            'whatsAppLink' => $this->generateWhatsAppLink(),
        ]);
    }

    public function addTag()
    {
        $this->tagsArray[$this->tagValue] = '';
        $this->tagValue = '';
        $this->tagValue = '';
        $this->generatedMessage = $this->generateMessage();
    }


    public function updatedMessage()
    {
        $this->generatedMessage = $this->generateMessage();
    }


    public function generateMessage()
    {
        $message = $this->message;
    
        foreach ($this->tagsArray as $tag => $value) {
            $message = str_replace("[$tag]", $value, $message);
        }
    
        return $message;
    }
    
    public function messageUpdated($value)
    {
        $this->message = $value;
    }

    public function startEditingTag($tag)
    {
        $this->editTag = $tag;
    }

    public function saveTag()
    {
        // Realiza las validaciones necesarias
        // Guarda las modificaciones de la etiqueta
        $this->editTag = null; // Finaliza la edición
        $this->generateMessage();
    }

    public function generateWhatsAppLink()
    {
        $phoneNumber = urlencode($this->tagsArray['Celular']); // Codifica el número de teléfono para que sea seguro en un URL
        $message = urlencode($this->generatedMessage); // Codifica el mensaje para que sea seguro en un URL

        return "https://api.whatsapp.com/send?phone={$phoneNumber}&text={$message}";
    }
    
    
}

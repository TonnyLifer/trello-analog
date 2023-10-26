<?php

namespace App\Livewire;

use App\Models\Card;
use App\Models\Group;
use Livewire\Component;

class Trello extends Component
{
    public $title;

    public $addGroupState = false;

    public $addCardState = '';

    protected $rules = [
        "title" => "required",
    ];

    //создание группы
    public function addGroup(){
        $this->addGroupState = true;
    }
    
    //удаление группы
    public function deleteGroup($id){
        Group::destroy($id);
    }

    //создание карточки
    public function addCard($group_id){
        $this->addCardState = $group_id;
    }   

    //удаление карточки
    public function deleteCard($id){
        Card::destroy($id);
    }

    public function save(){
        $data = $this->validate();

        if($this->addGroupState){
            Group::create($data);
        }else{
            $data['group_id'] = $this->addCardState;
            Card::create($data);
        }

        $this->reset();
    }

    public function sorting($order){
        foreach($order as $group){
            Group::where(["id" => $group['value']])->update(['sort' => $group['order']]);
            
            if(isset($group['items'])){
                foreach($group['items'] as $card){
                    Card::where(['id' => $card['value']])->update(['sort' => $card['order']]);
                }
            }
        }
    }

    public function render()
    {
        $groups = Group::orderBy('sort')->get();
        return view('livewire.trello',[
            'groups' => $groups
        ]);
    }
}

<?php

namespace App\Livewire\Pages\Dashboard;

use Livewire\Component;

class Index extends Component
{
    
        public function index()
        {
            // Logic for listing resources
        }
    
        public function create()
        {
            // Logic for showing the create resource form
        }
    
        public function store()
        {
            // Logic for storing a new resource
        }
    
        public function show($id)
        {
            // Logic for showing a single resource
        }
    
        public function edit($id)
        {
            // Logic for showing the edit resource form
        }
    
        public function update($id)
        {
            // Logic for updating a resource
        }
    
        public function destroy($id)
        {
            // Logic for deleting a resource
        }
    
        public function render()
        {
            return view('livewire.pages.dashboard.index');
        }
}

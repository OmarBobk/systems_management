<?php

namespace App\Http\Livewire;

use App\Models\Contributor;
use App\Models\Contribution;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Contributions extends Component
{
    public $contributors, $results, $editName, $editPhone, $editNotes, $name, $phone, $notes, $is_view_contributions;
    public $is_contribution_description, $is_contribution_profits_percent, $is_contribution_due_date, $is_contribution_amount;
    public $contribution_description, $contribution_profits_percent, $contribution_due_date, $contribution_deposit_date, $contribution_amount;
    public $is_create_new_contributor, $is_create_new_contribution;
    public $newContributorName, $newContributorPhone, $newContributorNotes;
    public $new_contribution_description, $new_contribution_profits_percent, $new_contribution_due, $new_contribution_amount;

    protected array $rules = [
        'newContributorName'  => 'required',
        'newContributorPhone' => 'required',
    ];

    public function render()
    {
        $this->testing = [
            'alert-message' => 'primary',
            'action'        => 'viewContributions',
            'icon'          => 'bold-down',
        ];
        $this->contributors = Contributor::all();

        return view('livewire.contributions.index-component')->layout('layouts.user');
    }

    /**
     * Toggle view Contributions table.
     *
     * @param $id
     */
    public function viewContributions($id)
    {
        $this->is_view_contributions = (isset($this->is_view_contributions))
            ? (isset($this->is_view_contributions[$id])
                ? (($this->is_view_contributions[$id])
                    ? [$id => false]
                    : [$id => true])
                : [$id => true])
            : [$id => false];

    }

    /**
     * Edit Contributor Name
     *
     * @param Contributor $contributor
     */
    public function editName(Contributor $contributor)
    {
        $this->editName  = [$contributor->id => true];
        $this->editPhone = [$contributor->id => false];
        $this->editNtoes = [$contributor->id => false];
        $this->name[$contributor->id] = $contributor->name;
    }

    /**
     * Update Contributor Name
     *
     * @param Contributor $contributor
     */
    public function updateNameEnter(Contributor $contributor)
    {
        $contributor->update(['name' => $this->name[$contributor->id]]);
        $this->editName = [$contributor->id => false];
    }

    /**
     * Close The Edit Contributor Name
     *
     * @param $id
     */
    public function closeUpdateNameEnter($id)
    {
        $this->editName = [$id => false];
    }



    /**
     * Edit Contributor Phone Number
     * @param Contributor $contributor
     */
    public function editPhone(Contributor $contributor)
    {
        $this->editName  = [$contributor->id => false];
        $this->editPhone = [$contributor->id => true];
        $this->editNotes = [$contributor->id => false];
        $this->phone[$contributor->id] = $contributor->phone;
    }

    /**
     * Update Contributor Phone Number
     *
     * @param Contributor $contributor
     */
    public function updatePhoneEnter(Contributor $contributor)
    {
        $contributor->update(['phone' => $this->phone[$contributor->id]]);
        $this->editPhone = [$contributor->id => false];
    }

    /**
     * Close The Edit Contributor Phone Number
     *
     * @param $id
     */
    public function closeUpdatePhoneEnter($id)
    {
        $this->editPhone = [$id => false];
    }



    /**
     * Edit Contributor Notes Number
     * @param Contributor $contributor
     */
    public function editNotes(Contributor $contributor)
    {
        $this->editName  = [$contributor->id => false];
        $this->editPhone = [$contributor->id => false];
        $this->editNotes = [$contributor->id => true];
        $this->notes[$contributor->id] = $contributor->notes;
    }

    /**
     * Update Contributor Notes Number
     *
     * @param Contributor $contributor
     */
    public function updateNotesEnter(Contributor $contributor)
    {
        $contributor->update(['notes' => $this->notes[$contributor->id]]);
        $this->editNotes = [$contributor->id => false];
    }

    /**
     * Close The Edit Contributor Notes Number
     *
     * @param $id
     */
    public function closeUpdateNotesEnter($id)
    {
        $this->editNotes = [$id => false];
    }








    public function editDescription($id, Contribution $contribution)
    {
        $this->determineWhatToEdit($id, $contribution->id, 'description');
        $this->contribution_description[$id][$contribution->id]    = $contribution->description;
    }

    public function updateContributionDescription($id, Contribution $contribution)
    {
        $contribution->update(['description' => $this->contribution_description[$id][$contribution->id]]);
        $this->is_contribution_description = [$id => [$contribution->id => false]];
    }

    public function closeDescription($contributor_id, $contribution_id)
    {
        $this->is_contribution_description = [$contributor_id => [$contribution_id => false]];
    }



    public function editProfitsPercent($id, Contribution $contribution)
    {
        $this->determineWhatToEdit($id, $contribution->id, 'profits_percent');
        $this->contribution_profits_percent[$id][$contribution->id]    = $contribution->profits_percent;
    }

    public function updateContributionProfitsPercent($id, Contribution $contribution)
    {
        $contribution->update(['profits_percent' => $this->contribution_profits_percent[$id][$contribution->id]]);
        $this->is_contribution_profits_percent = [$id => [$contribution->id => false]];
    }

    public function closeProfitsPercent($contributor_id, $contribution_id)
    {
        $this->is_contribution_profits_percent = [$contributor_id => [$contribution_id => false]];
    }



    public function editAmount($id, Contribution $contribution)
    {
        $this->determineWhatToEdit($id, $contribution->id, 'amount');
        $this->contribution_amount[$id][$contribution->id]  = $contribution->amount;
    }

    public function updateContributionAmount($id, Contribution $contribution)
    {
        $contribution->update(['amount' => $this->contribution_amount[$id][$contribution->id]]);
        $this->is_contribution_amount = [$id => [$contribution->id => false]];
    }

    public function closeAmount($contributor_id, $contribution_id)
    {
        $this->is_contribution_amount = [$contributor_id => [$contribution_id => false]];
    }



    public function addNewContributor()
    {
        $this->resetCreateNewContributorForm();
        $this->is_create_new_contributor = true;
    }

    public function store()
    {

        $this->validate();

        Contributor::create([
            'name'        => $this->newContributorName,
            'phone'       => $this->newContributorPhone,
            'notes'       => $this->newContributorNotes,
        ]);

        session()->flash('message', 'Contributor Created');
        session()->flash('alert' , 'success');

        $this->closeCreateContributorComponent();
        $this->resetCreateNewContributorForm();

    }

    public function closeCreateContributorComponent()
    {
        $this->is_create_new_contributor = false;
    }

    public function resetCreateNewContributorForm()
    {
        $this->reset('newContributorName', 'newContributorPhone', 'newContributorNotes');
    }



    public function createNewContribution($id)
    {
        $this->resetCreateNewContributionForm();
        $this->is_create_new_contribution = [$id => true];
    }

    public function storeContribution($contributor_id)
    {
        $this->validate([
            'new_contribution_profits_percent'  => 'required|integer',
            'new_contribution_amount'           => 'required|integer',
            'new_contribution_due_date'         => 'required',
            'new_contribution_deposit_date'     => 'required',
        ]);

        Contribution::create([
            'description'       => $this->new_contribution_description,
            'profits_percent'   => $this->new_contribution_profits_percent,
            'amount'            => $this->new_contribution_amount,
            'due_date'          => $this->new_contribution_due_date,
            'deposit_date'      => $this->new_contribution_deposit_date,
            'contributor_id'    => $contributor_id,
        ]);

        session()->flash('message', 'Contribution Created');
        session()->flash('alert' , 'success');

        $this->closeCreateContributionComponent();
        $this->resetCreateNewContributionForm();

    }

    public function closeCreateContributionComponent()
    {
        $this->is_create_new_contribution = false;
    }

    public function resetCreateNewContributionForm()
    {
        $this->reset( 'new_contribution_description', 'new_contribution_profits_percent', 'new_contribution_deposit_date', 'new_contribution_due_date', 'new_contribution_amount');
    }



    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }


    /**
     * Helper function
     * @param $contributor_id
     * @param Contribution $contribution
     */
    public function determineWhatToUpdate($contributor_id, Contribution $contribution)
    {
        $available_methods = [
            $this->is_contribution_description     [$contributor_id][$contribution->id] => 'updateContributionDescription',
            $this->is_contribution_profits_percent [$contributor_id][$contribution->id] => 'updateContributionProfitsPercent',
            $this->is_contribution_amount          [$contributor_id][$contribution->id] => 'updateContributionAmount',
        ];

        // calling the method
        $this->{$available_methods[1]}($contributor_id, $contribution);

    }

    /**
     * Helper function
     * @param $contributor_id
     * @param $contribution_id
     */
    public function determineWhatToClose($contributor_id, $contribution_id)
    {
        $available_methods = [
            $this->is_contribution_description     [$contributor_id][$contribution_id] => 'closeDescription',
            $this->is_contribution_profits_percent [$contributor_id][$contribution_id] => 'closeProfitsPercent',
            $this->is_contribution_amount          [$contributor_id][$contribution_id] => 'closeAmount',
        ];

        // calling the method
        $this->{$available_methods[1]}($contributor_id, $contribution_id);

    }

    public function determineWhatToEdit($contributor_id, $contribution_id, $field)
    {
        $description        = [$contributor_id => [$contribution_id => false]];
        $profits_percent    = [$contributor_id => [$contribution_id => false]];
        $amount             = [$contributor_id => [$contribution_id => false]];
        $$field             = [$contributor_id => [$contribution_id => true]];

        $this->is_contribution_description          = $description;
        $this->is_contribution_profits_percent      = $profits_percent;
        $this->is_contribution_amount               = $amount;

    }

    public function test()
    {
        $x = [
            2 => 3,

        ];
    }

}

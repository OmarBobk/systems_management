<?php

namespace App\Http\Livewire;

use App\Models\Contributor;
use App\Models\Contribution;
use Carbon\Carbon;
use Livewire\Component;

class Contributions extends Component
{

    public $contributors, $results, $editName, $editPhone, $editNotes, $name, $phone, $notes, $is_view_contributions;

    public $is_contribution_description, $is_contribution_profits_percent, $is_contribution_due_date,
        $is_contribution_deposit_date, $is_contribution_amount, $is_contribution_returned_date, $is_contribution_status;
    public $contribution_description, $contribution_profits_percent, $contribution_due_date, $contribution_deposit_date,
        $contribution_amount, $contribution_returned_date, $contribution_status;

    public $is_create_new_contributor, $is_create_new_contribution;
    public $new_contribution_description, $new_contribution_profits_percent, $new_contribution_due_date,
        $new_contribution_deposit_date, $new_contribution_amount;

    public $contributor_profits;

    public function mount()
    {
        $this->is_view_contributions = false;
    }

    public function render()
    {
        $this->contributors = Contributor::with(['contributions' => function ( $query) {
            $query->withSum('profits', 'amount');
        }])->get();

        foreach ($this->contributors as $contributor) {
            $res = 0;

            foreach ($contributor->contributions as $contribution) {
                $res += $contribution->profits_sum_amount;
            }

            $this->contributor_profits[$contributor->id] = $res;
        }

        return view('livewire.contributions.index-component')->layout('layouts.user');
    }

    public function set_contributor_profits()
    {


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
            : [$id => true];

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
        $this->editNotes = [$contributor->id => false];
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
        $this->validate(["contribution_amount.$id.$contribution->id" => 'required|numeric']);
        $contribution->update(['amount' => $this->contribution_amount[$id][$contribution->id]]);
        $this->is_contribution_amount = [$id => [$contribution->id => false]];
    }

    public function closeAmount($contributor_id, $contribution_id)
    {
        $this->is_contribution_amount = [$contributor_id => [$contribution_id => false]];
    }



    public function editDepositDate($id, Contribution $contribution)
    {
        $this->determineWhatToEdit($id, $contribution->id, 'deposit_date');
        $this->contribution_deposit_date[$id][$contribution->id]  = $contribution->deposit_date;
    }

    public function updateContributionDepositDate($id, Contribution $contribution)
    {
        $contribution->update(['deposit_date' => $this->contribution_deposit_date[$id][$contribution->id]]);
        $this->is_contribution_deposit_date = [$id => [$contribution->id => false]];
    }

    public function closeDepositDate($contributor_id, $contribution_id)
    {
        $this->is_contribution_deposit_date = [$contributor_id => [$contribution_id => false]];
    }




    public function editDueDate($id, Contribution $contribution)
    {
        $this->determineWhatToEdit($id, $contribution->id, 'due_date');
        $this->contribution_due_date[$id][$contribution->id]  = $contribution->due_date;
    }

    public function updateContributionDueDate($id, Contribution $contribution)
    {
        $contribution->update(['due_date' => $this->contribution_due_date[$id][$contribution->id]]);
        $this->is_contribution_due_date = [$id => [$contribution->id => false]];
    }

    public function closeDueDate($contributor_id, $contribution_id)
    {
        $this->is_contribution_due_date = [$contributor_id => [$contribution_id => false]];
    }


    public function editReturnedDate($id, Contribution $contribution)
    {
        $this->determineWhatToEdit($id, $contribution->id, 'returned_date');
        $this->contribution_returned_date[$id][$contribution->id]  = $contribution->returned_date;
    }

    public function updateContributionReturnedDate($id, Contribution $contribution)
    {
        $contribution->update(['returned_date' => $this->contribution_returned_date[$id][$contribution->id]]);
        $this->is_contribution_returned_date = [$id => [$contribution->id => false]];
    }

    public function closeReturnedDate($contributor_id, $contribution_id)
    {
        $this->is_contribution_returned_date = [$contributor_id => [$contribution_id => false]];
    }




    public function editStatus($id, Contribution $contribution)
    {
        $this->determineWhatToEdit($id, $contribution->id, 'status');
        $this->contribution_status[$id][$contribution->id]  = $contribution->status;
    }

    public function updateContributionStatus($id, Contribution $contribution)
    {
        $contribution->update(['status' => $this->contribution_status[$id][$contribution->id]]);
        if ($contribution->returned_date == null) {
            $contribution->update(['returned_date' => Carbon::now()]);
        }
        $this->is_contribution_status = [$id => [$contribution->id => false]];
    }

    public function closeStatus($contributor_id, $contribution_id)
    {
        $this->is_contribution_status = [$contributor_id => [$contribution_id => false]];
    }



    public function addNewContributor()
    {
        $this->resetCreateNewContributorForm();
        $this->is_create_new_contributor = true;
    }

    public function storeContributor()
    {
        $now = Carbon::now();

        $this->validate([
            'name'  => 'required',
            'phone' => 'required',
            'notes' => 'required',
            ]);

        Contributor::create([
            'name'              => $this->name,
            'phone'             => $this->phone,
            'notes'             => $this->notes,
            'created_at'        => $now,
            'updated_at'        => $now,
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
        $this->reset('name', 'phone', 'notes');
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
            $this->is_contribution_deposit_date    [$contributor_id][$contribution->id] => 'updateContributionDepositDate',
            $this->is_contribution_due_date        [$contributor_id][$contribution->id] => 'updateContributionDueDate',
            $this->is_contribution_returned_date   [$contributor_id][$contribution->id] => 'updateContributionReturnedDate',
            $this->is_contribution_status          [$contributor_id][$contribution->id] => 'updateContributionStatus',
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
            $this->is_contribution_deposit_date    [$contributor_id][$contribution_id] => 'closeDepositDate',
            $this->is_contribution_due_date        [$contributor_id][$contribution_id] => 'closeDueDate',
            $this->is_contribution_returned_date   [$contributor_id][$contribution_id] => 'closeReturnedDate',
            $this->is_contribution_status          [$contributor_id][$contribution_id] => 'closeStatus',
        ];

        // calling the method
        $this->{$available_methods[1]}($contributor_id, $contribution_id);

    }

    public function determineWhatToEdit($contributor_id, $contribution_id, $field)
    {
        $description        = [$contributor_id => [$contribution_id => false]];
        $profits_percent    = [$contributor_id => [$contribution_id => false]];
        $amount             = [$contributor_id => [$contribution_id => false]];
        $deposit_date       = [$contributor_id => [$contribution_id => false]];
        $due_date           = [$contributor_id => [$contribution_id => false]];
        $returned_date      = [$contributor_id => [$contribution_id => false]];
        $status             = [$contributor_id => [$contribution_id => false]];

        // overwrite one of the defined variables.
        $$field             = [$contributor_id => [$contribution_id => true]];

//        $this->{"is_contribution_$field"}           = $$field;

        $this->is_contribution_description          = $description;
        $this->is_contribution_profits_percent      = $profits_percent;
        $this->is_contribution_amount               = $amount;
        $this->is_contribution_deposit_date         = $deposit_date;
        $this->is_contribution_due_date             = $due_date;
        $this->is_contribution_returned_date        = $returned_date;
        $this->is_contribution_status               = $status;

    }
}

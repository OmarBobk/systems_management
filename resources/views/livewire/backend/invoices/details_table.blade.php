{{--Invoices Table--}}

@if(isset($this->is_view_customer_details[$item->id]))
    @if($this->is_view_customer_details[$item->id])
        <tr>
            <td colspan="4" class=" text-gray-600 !px-2 sm:!px-10 py-3 border-t border-gray-100 whitespace-nowrap">
                @include('livewire.backend.invoices.invoices')
            </td>
        </tr>
    @endif
@endif
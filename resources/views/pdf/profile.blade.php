<style type="text/css">
.logo-header,
.right-header {
	width: 50%;
	float: left;
}
.right-header span{
	background: #5EB495;
    color: #fff;
    float: right;
    padding: 10px;
    font-size: 16px;
    margin-top: 20px;
}
*{
	font-size: 14px;
	font-family: sans-serif;
}
.persnol-details{
	background: #5EB495;
    float: left;
    width: 100%;
    margin-top: 40px;
}
.persnol-details h6{
	color: #fff;
    margin: 0px;
    padding: 10px;
}
.form {
    float: left;
    width: 100%;
    border-bottom: 1px solid #f3f3f3;
    padding-bottom: 7px;
    margin-top: 18px;
    margin-bottom: 10px;
}
.half-form{
	float: left;
    width: 48%;
    border-bottom: 1px solid #f3f3f3;
    padding-bottom: 7px;
    margin-top: 18px;
    margin-bottom: 10px;
}
.half-form-mgn{
	float: left;
    width: 48%;
    margin-left: 4%;
    border-bottom: 1px solid #f3f3f3;
    padding-bottom: 7px;
    margin-top: 18px;
    margin-bottom: 10px;
}
.form h6,
.half-form-mgn h6,
.half-form h6 {
    float: left;
    margin: 0;
    margin-left: 15px;
    font-weight: normal;
    font-size: 16px;
}
.form label,
.half-form-mgn label,
.half-form label {
    float: left;
    position: relative;
    display: block;
}
.form label:after,
.half-form-mgn label:after,
.half-form label:after{
    position: absolute;
    content: "";
    width: 105%;
    height: 2px;
    background: #fff;
    z-index: 1;
    left: 0;
    bottom: -11px;

}
.clear{
	clear: both;
}
table td{
	font-weight: normal;
	font-size: 14px;
}



</style>


<div class="logo-header">
 <img src="{{ $bank_logo }}" style="width: 130px;"> 
</div>
<div class="right-header">
<span>{{ $service->name }} Application Form</span>
</div>
<div class="clear"></div>
<div class="persnol-details">
<h6>Personal Details</h6>
</div>
<div class="clear"></div>
<table style="width: 100%">
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Salutation :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $result->salutation }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;">First Name :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $result->name }}</td>
	</tr>
	@if($result->middle_name)
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;">Middle Name :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $result->middle_name }}</td>
    </tr>
    @endif
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;">Last Name :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $result->last_name }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;">Gender :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $result->gender }}</td>
    </tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;">Date Of Birth :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $result->date_of_birth }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;">Mobile :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $result->mobile }}</td>
    </tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;">Email :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $result->email }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;">Marital Status :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $result->marital_status }}</td>
    </tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;">Number of Dependents :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $result->no_of_dependents }}</td>
	</tr>
    <tr>
        <td style="padding-bottom: 10px;padding-top: 15px;">Emirates I D :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $result->eid_number }}</td>
    </tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;">Passport Number :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $result->passport_number }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;">Nationality :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">
        	@foreach($country as $country1)       
            @if($country1->id == $result->nationality) 
            {{ $country1->country_name }} @endif
            @endforeach  
        </td>
	</tr>

</table>

<div class="clear"></div>
<div class="persnol-details">
<h6>Employment Details</h6>
</div>
<div class="clear"></div>
@if($result->cm_type == 1)
<h6 style="float: left;color: #fff;background: #FF6722; padding: 9px 22px;border: 1px solid #000; border-radius: 25px; margin-right: 25px; font-size: 14px; margin-bottom: 5px; margin-top: 10px;">Salaried</h6>
<div class="clear"></div>
<table style="width: 100%">
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Company name :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $result->company_name }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;">Date of joining :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $result->date_of_joining }}</td>
	</tr>

	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;max-width: 220px">Monthly salary :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $result->monthly_salary }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;">Date of joining :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $result->date_of_joining }}</td>
	</tr>
    @if($result->last_one_salary_credits != '' || $result->last_two_salary_credits != '' || $result->last_three_salary_credits != '' )
		<tr>
	        <td style="padding-bottom: 10px;padding-top: 15px;">Last three salary credits :</td>
	        <td style="border-bottom: 1px solid #f3f3f3;">{{ $result->last_one_salary_credits }}, {{ $result->last_two_salary_credits }}, {{ $result->last_three_salary_credits }} </td>
		</tr>
    @endif
    <tr>
        <td style="padding-bottom: 10px;padding-top: 15px;">Company provided accommodation :</td>
        <td style="border-bottom: 1px solid #f3f3f3;"> @if($result->accommodation_company == 0) No @else Yes @endif </td>
	</tr>
</table>
@endif

@if($result->cm_type == 2)
<h6 style="float: left;color: #fff;background: #FF6722; padding: 9px 22px;border: 1px solid #000; border-radius: 25px; margin-right: 25px; font-size: 14px; margin-bottom: 5px; margin-top: 10px;">Self Employed</h6>
<div class="clear"></div>
<table style="width: 100%">
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Company name :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $result->self_company_name }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;">Percentage ownership :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $result->percentage_ownership }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;max-width: 220px">Type of profession/business :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $result->profession_business }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;">Annual Business Income :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $result->annual_business_income }}</td>
	</tr>
</table>
@endif

@if($result->cm_type == 3)
<h6 style="float: left;color: #fff;background: #FF6722; padding: 9px 22px;border: 1px solid #000; border-radius: 25px; margin-right: 25px; font-size: 14px; margin-bottom: 5px; margin-top: 10px;">Pension</h6>
<div class="clear"></div>
<table style="width: 100%">
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Monthly pension :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $result->monthly_pension }}</td>
	</tr>
</table>
@endif

@if($app_data)
@if($app_data->residential_address_line_1)
<div class="clear"></div>
<div class="persnol-details" style="margin-bottom: 15px;">
    <h6>Address & Contact Details</h6>
</div>
<div class="clear"></div>
<b>Residential Address Details</b>
<div class="clear"></div>
<table style="width: 100%">
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Residential Address Line 1 :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->residential_address_line_1 }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Residential Address Line 2 :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->residential_address_line_2 }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Residential Address Line 3 :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->residential_address_line_3 }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Nearest Landmark :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->residential_address_nearest_landmark }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;max-width: 220px">Emirate :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->residential_emirate }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;max-width: 220px">PO Box No :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->residential_po_box }}</td>
	</tr>
    <tr>
        <td style="padding-bottom: 10px;padding-top: 15px;max-width: 220px">Residence Type :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->resdence_type }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;max-width: 220px">Annual Rent :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->annual_rent }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;max-width: 220px">Duration At Current Address :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->duration_at_current_address }}</td>
	</tr>

</table>

<div class="clear"></div>
<b>Office Address</b>
<div class="clear"></div>
<table style="width: 100%">
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Company Name :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->company_name }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Company Phone No :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->company_phone_no }}</td>
	</tr>
    <tr>
        <td style="padding-bottom: 10px;padding-top: 15px;max-width: 220px">Address Line 1 :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->company_address_line_1 }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;max-width: 220px">Address Line 2 :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->company_address_line_2 }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;max-width: 220px">Address Line 3 :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->company_address_line_3 }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;max-width: 220px">Po Box No :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->company_po_box }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;max-width: 220px">Emirate :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->company_emirate }}</td>
	</tr>
</table>
<div class="clear"></div>
<b>Permanent Address In Home Country</b>
<div class="clear"></div>
<table style="width: 100%">
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Address Line 1 :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->permanent_address_home_country_line_1 }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Address Line 2 :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->permanent_address_home_country_line_2 }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Address Line 3 :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->permanent_address_home_country_line_3 }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">City :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->permanent_address_city }}</td>
	</tr>
    <tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Country :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">
            @foreach($country as $country)       
                @if($country->id == $app_data->permanent_address_country)
                    {{ $country->country_name }}
                @endif
            @endforeach 
        </td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;max-width: 220px">Zip/Pin Code :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->permanent_address_zipcode }}</td>
	</tr>

	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;max-width: 220px">Tel. with IDD Code :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->permanent_addresstel_with_idd_code }}</td>
	</tr>
</table>

<div class="clear"></div>
<b>Mailing Address</b>
<div class="clear"></div>
<table style="width: 100%">
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Po Box :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->mailing_po_box }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;max-width: 220px">Address Line 1 :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->mailing_address_line }}</td>
	</tr>

	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;max-width: 220px">Emirate :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->mailing_emirate }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;max-width: 220px">Preferred Mailing Address :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->resdence_type }}</td>
	</tr>

	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;max-width: 220px">Preferred Statement Mode :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->preferred_statement_mode }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;max-width: 220px">Preferred Contact Number :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->preferred_contact_number }}</td>
	</tr>
</table>

@endif

@if($app_data->multi_nationality_name)
<div class="clear"></div>
<div class="persnol-details" style="margin-bottom: 15px;">
    <h6>Multiple Nationality Holder Details</h6>
</div>
<div class="clear"></div>
<table style="width: 100%">
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 200px">Nationality Name :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->multi_nationality_name }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Passport Number :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->multi_passport_number }}</td>
	</tr>
</table>
@endif
@endif


@if($result->service_id == 3)
@if($app_data->card_type)
<div class="clear"></div>
<div class="persnol-details" style="margin-bottom: 15px;">
    <h6>Card Information</h6>
</div>
<div class="clear"></div>
<table style="width: 100%">
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Card Type :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->card_type }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Embossing Name :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->embossing_name }}</td>
	</tr>
    @if(count($CardTypePreference) != 0)
        <tr>
            <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Preferred Card Type :</td>
            <td style="border-bottom: 1px solid #f3f3f3;">
            	@php
                $i = 1;
            	@endphp
                @foreach($CardTypePreference as $CardType)
            	@if($i != 1), @endif {{ $CardType->name }} 
                
                @php
                $i++;
            	@endphp
                @endforeach
            </td>
	    </tr>
    @endif
</table>

<div class="clear"></div>
<div class="persnol-details" style="margin-bottom: 15px;">
    <h6>Supplementary Applicant(S) Cards Details</h6>
</div>
<div class="clear"></div>
<table style="width: 100%">
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Salutation :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->supplementary_salutation }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">First Name :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->supplementary_first_name }}</td>
	</tr>
    @if($app_data->supplementary_middle_name)
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Middle Name :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->supplementary_middle_name }}</td>
	</tr>
    @endif

	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Last Name :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->supplementary_last_name }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Relationship :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->supplementary_relationship }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Embossing Name :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->supplementary_embosing_name }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Nationality :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">
        	@foreach($countries as $country)
              @if($app_data->supplementary_nationality == $country->id) {{ $country->country_name }} @endif
            @endforeach
        </td>
	</tr>

    <tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Passport No :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->supplementary_passport_no }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Card limit :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->supplementary_credit_limit_aed }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Marital Status :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->supplementary_marital_status }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Mother'S Maiden Name :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $app_data->supplementary_mother_maiden_name }}</td>
	</tr>
</table>
@endif
@endif

@if($result->service_id == 1)
@if($Personalloanform)

<div class="clear"></div>
<div class="persnol-details" style="margin-bottom: 15px;">
    <h6>Personal Loan Application</h6>
</div>
<div class="clear"></div>
<table style="width: 100%">
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Purpose Of Loan :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->purpose_of_loan }}</td>
	</tr>
</table>
<div class="clear"></div>
<b>Existing Financing Details/Other Banking Relationship</b>
<div class="clear"></div>
<table style="width: 100%">
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Institution Name :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->institution_name }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Product/Card Type :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->product_card_type }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Account/Card Number :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->account_card_number }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Finance Amount :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->finance_amount }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Monthly Installment :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->monthly_installment }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Outstanding Balance :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->outstanding_balance }}</td>
	</tr>
</table>
<div class="clear"></div>
<b>Personal Finance Details</b>
<div class="clear"></div>
<table style="width: 100%">
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Type Of Personal Finance :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->type_of_personal_finance }}</td>
	</tr>

</table>

<div class="clear"></div>
<b>Information On Liabilities</b>
<div class="clear"></div>
<table style="width: 100%">
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Bank Name :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->liabilities_bank_name }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Facility Type :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->liabilities_facility_type }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Monthly Installment Amount :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->liabilities_monthly_installment_amount }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Outstanding Amount :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->liabilities_outstanding_amount }}</td>
	</tr>
</table>

<div class="clear"></div>
<b>Customer'S Liabilities With Other Banks That Are To Be Settled</b>
<div class="clear"></div>
<table style="width: 100%">
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Bank Name :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->liabilities_other_bank_name }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Facility Type :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->liabilities_other_facility_type }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Monthly Installment Amount :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->liabilities_other_monthly_installment_amount }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Outstanding Amount :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->liabilities_other_outstanding_amount }}</td>
	</tr>
</table>

<div class="clear"></div>
<div class="persnol-details" style="margin-bottom: 15px;">
<h6>Reference Person In Home Country</h6>
</div>
<div class="clear"></div>
<table style="width: 100%">
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Salutation :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->reference_title }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Full Name :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->reference_full_name }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Relation :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->reference_relation }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Mobile No :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->reference_mobile_no }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Home Telephone No :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->reference_home_telephone_no }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Address :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->reference_address }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Po Box No :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->reference_po_box_no }}</td>
	</tr>
</table>


<div class="clear"></div>
<div class="persnol-details" style="margin-bottom: 15px;">
<h6>Business Reference</h6>
</div>
<div class="clear"></div>
<table style="width: 100%">
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Company Name :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->business_reference_company_name }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Salutation :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->business_title }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Contact Person’S Name :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->business_contact_person_name }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Designation In The Company :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->business_designation }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Relation :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->business_relationship }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Contact Number :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->business_contact_number }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Address :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->business_address }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Emirate :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->business_emirate }}</td>
	</tr>
</table>


<div class="clear"></div>
<div class="persnol-details" style="margin-bottom: 15px;">
<h6>Reference 1</h6>
</div>
<div class="clear"></div>
<table style="width: 100%">
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Salutation :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->reference_1_title }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Full Name :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->reference_1_name }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Relation :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->reference_1_relation }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Mobile No :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->reference_1_mobile_no }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Emirate :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->reference_1_emirate }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Address :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->reference_address }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Po Box No :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->reference_po_box_no }}</td>
	</tr>
</table>


<div class="clear"></div>
<div class="persnol-details" style="margin-bottom: 15px;">
<h6>Reference 2</h6>
</div>
<div class="clear"></div>
<table style="width: 100%">
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Salutation :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->reference_2_title }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Full Name :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->reference_2_name }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Relation :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->reference_2_relation }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Mobile No :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->reference_2_mobile_no }}</td>
	</tr>
	<tr>
        <td style="padding-bottom: 10px;padding-top: 15px;width: 220px">Emirate :</td>
        <td style="border-bottom: 1px solid #f3f3f3;">{{ $Personalloanform->reference_2_emirate }}</td>
	</tr>
</table>

@endif
@endif



@extends('admin.adminlayouts.adminlayout')

@section('head')

    <!-- BEGIN PAGE LEVEL STYLES -->
    {!! HTML::style('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') !!}
    {!! HTML::style('assets/global/plugins/bootstrap-datepicker/css/datepicker3.css') !!}
    <!-- END PAGE LEVEL STYLES -->

@stop


@section('mainarea')

    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">
        <span class="fa fa-plus"></span> Nouvel employé
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="index.html">Accueil</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="{{route('admin.employees.index')}}">employés</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Nouvel employé</a>
            </li>
        </ul>
    </div>
    <!-- END PAGE HEADER-->

    @if(count($department)==0)
        <div class="note note-warning">
            {!! Lang::get('messages.noDept') !!}
        </div>
    @else
        <div class="row">
            <div class="col-md-6">


            </div>
            <div class="col-md-6 form-group text-right">

                <span id="load_notification"></span>
                <input type="checkbox" onchange="ToggleEmailNotification('employee_add');return false;"
                       class="make-switch" name="employee_add" @if($setting->employee_add==1)checked
                       @endif data-on-color="success" data-on-text="Yes" data-off-text="No" data-off-color="danger">
                <strong>Email Notification</strong><br>


            </div>
        </div>

        {{--INLCUDE ERROR MESSAGE BOX--}}
        @include('admin.common.error')
        {{--END ERROR MESSAGE BOX--}}
        <hr>
        <div class="clearfix">
        </div>
        {!! Form::open(array('route'=>"admin.employees.store",'id'=>'addEmployeeForm','class'=>'form-horizontal','method'=>'POST','files' => true)) !!}
        <div class="row ">
            <div class="col-md-6 col-sm-6">
                <div class="portlet box purple-wisteria">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-calendar"></i>Agent
                        </div>

                    </div>
                    <div class="portlet-body">

                        <div class="form-body">
                            <div class="form-group ">
                                <label class="control-label col-md-3">Photo</label>
                                <div class="col-md-9">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
                                                 alt=""/>

                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"
                                             style="max-width: 200px; max-height: 150px;">
                                        </div>
                                        <div>
        													<span class="btn default btn-file">
        													<span class="fileinput-new">
        													Select image </span>
        													<span class="fileinput-exists">
        													Change </span>
        													 <input type="file" name="profileImage">
        													</span>
                                            <a href="#" class="btn btn-sm red fileinput-exists"
                                               data-dismiss="fileinput">
                                                Remove </a>
                                        </div>
                                    </div>
                                    <div class="clearfix margin-top-10">
                                                        <span class="label label-danger">
                                                        NOTE! </span> Image Size must be (872px by 724px)

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Prénom(s) et Nom <span class="required">* </span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="fullName" placeholder="Prénom(s) et Nom"
                                           value="{{ \Illuminate\Support\Facades\Input::old('fullName') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Profession</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="fatherName" placeholder="Profession">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Fonction</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="fonction" placeholder="Fonction">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Date de Naissance</label>
                                <div class="col-md-3">
                                    <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy"
                                         data-date-viewmode="years">
                                        <input type="text" class="form-control" name="date_of_birth" readonly
                                               value="{{ \Illuminate\Support\Facades\Input::old('date_of_birth') }}">
                                        <span class="input-group-btn">
        												<button class="btn default" type="button"><i
                                                                    class="fa fa-calendar"></i></button>
        												</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Lieu de Naissance
                                    </label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="localAddress"
                                              rows="3">{{\Illuminate\Support\Facades\Input::old('localAddress')}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Genre</label>
                                <div class="col-md-9">
                                    {!!  Form::select('gender', array('masculin' => 'Masculin', 'féminin' => 'Féminin'), \Illuminate\Support\Facades\Input::old('gender'),array('class'=>'form-control'))  !!}
                                </div>
                            </div>

                           <div class="form-group">
                                <label class="col-md-3 control-label">Campus du Site</label>
                                <div class="col-md-9">
                                 {!!  Form::select('campus', array('kaolack' => 'Kaolack', 'fatick' => 'Fatick', 'kaffrine' => 'Kaffrine', 'bureau_de_liaison' => 'Bureau de Liaison'), \Illuminate\Support\Facades\Input::old('campus'),array('class'=>'form-control'))  !!}   
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-md-3 control-label">Site</label>
                                <div class="col-md-9">
                                 {!!  Form::select('site', array('lfa' => 'LFA', 'efi' => 'EFI', 'khelcom_birane' => 'Khelcom Birane', 'salle_polyvalente' => 'Salle Polyvalente', 'srfpe' => 'SRFPE', 'ancienne_mairie' => 'Ancienne Mairie', 'lycée_khar_coumba_ndoffène' => 'Lycée Khar Coumba NDOFFENE', 'bst' => 'BST', 'rectorat' => 'Rectorat', 'bureau_de_liason' => 'Bureau de Liaison'), \Illuminate\Support\Facades\Input::old('site'),array('class'=>'form-control'))  !!}   
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-md-3 control-label">Situation Matrimoniale</label>
                                <div class="col-md-9">
                                    {!!  Form::select('situation', array('célibataire' => 'Célibataire', 'marié' => 'Marié'), \Illuminate\Support\Facades\Input::old('situation'),array('class'=>'form-control'))  !!}
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-md-3 control-label">Statut de l'employé</label>
                                <div class="col-md-9">
                                    {!!  Form::select('statut', array('permanent' => 'Permanent', 'contractuel' => 'Contractuel'), \Illuminate\Support\Facades\Input::old('statut'),array('class'=>'form-control'))  !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Téléphone</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="mobileNumber"
                                           placeholder="Téléphone"
                                           value="{{\Illuminate\Support\Facades\Input::old('mobileNumber')}}">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label">Permanent Address</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="permanentAddress"
                                              rows="3">{{\Illuminate\Support\Facades\Input::old('permanentAddress')}}</textarea>
                                </div>
                            </div>

                            <h4><strong>Account Login</strong></h4>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Email<span class="required">* </span></label>
                                <div class="col-md-9">
                                    <input type="text" name="email" class="form-control"
                                           value="{{ \Illuminate\Support\Facades\Input::old('email') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Password<span class="required">* </span></label>
                                <div class="col-md-9">
                                    <input type="hidden" name="oldpassword">
                                    <input type="password" name="password" class="form-control"
                                           value="{{ \Illuminate\Support\Facades\Input::old('password') }}">
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="portlet box red-sunglo">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-calendar"></i>Autres informations
                        </div>

                    </div>
                    <div class="portlet-body">

                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Matricule de Solde<span
                                            class="required">* </span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="employeeID" placeholder="Matricule de Solde"
                                           value="{{\Illuminate\Support\Facades\Input::old('employeeID')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">UFR</label>
                                <div class="col-md-9">
                                    {!!  Form::select('department', $department,null,['class' => 'form-control select2me','id'=>'department','onchange'=>'dept();return false;'])  !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Département</label>
                                <div class="col-md-9">

                                    <select class="select2me form-control" name="designation" id="designation">

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Date d'entrée à l'établissement</label>
                                <div class="col-md-3">
                                    <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy"
                                         data-date-viewmode="years">
                                        <input type="text" class="form-control" name="joiningDate" readonly
                                               value="{{\Illuminate\Support\Facades\Input::old('joiningDate')}}">
                                        <span class="input-group-btn">
        												<button class="btn default" type="button"><i
                                                                    class="fa fa-calendar"></i></button>
        												</span>
                                    </div>
                                </div>
                            </div>
                           <!-- <div class="form-group">
                                <label class="col-md-3 control-label">Joining Salary</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="currentSalary"
                                           placeholder="Current Salary"
                                           value="{{ \Illuminate\Support\Facades\Input::old('currentSalary') }}">
                                </div>
                            </div>-->
                        </div>

                    </div>
                </div>

                <div class="portlet box red-sunglo">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-calendar"></i>Informations bancaires
                        </div>

                    </div>
                    <div class="portlet-body">

                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Nom du type de compte</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="accountName"
                                           placeholder="Nom du type de compte"
                                           value="{{\Illuminate\Support\Facades\Input::old('accountName')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Numéro de compte</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="accountNumber"
                                           placeholder="Numéro de compte"
                                           value="{{\Illuminate\Support\Facades\Input::old('accountNumber')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Nom de la Banque</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="bank" placeholder="Nom de la Banque"
                                           value="{{\Illuminate\Support\Facades\Input::old('bank')}}">
                                </div>
                            </div>
                            <!--<div class="form-group">
                                <label class="col-md-3 control-label">IFSC Code</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="ifsc" placeholder="IFSC Code"
                                           value="{{\Illuminate\Support\Facades\Input::old('ifsc')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">PAN Number </label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="pan" placeholder="PAN Number"
                                           value="{{\Illuminate\Support\Facades\Input::old('pan')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Branch</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="branch" placeholder="BRANCH"
                                           value="{{\Illuminate\Support\Facades\Input::old('branch')}}">
                                </div>
                            </div>-->
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix">
            {{---------------Documents------------------}}
            <div class="row ">
                <div class="col-md-12 col-sm-12">
                    <div class="portlet box purple-wisteria">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-calendar"></i>Documents
                            </div>

                        </div>
                        <div class="portlet-body">

                            <div class="form-body">
                            <div class="form-group">
                                    <label class="control-label col-md-2">CV</label>
                                    <div class="col-md-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input" data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp; <span
                                                            class="fileinput-filename">
        														</span>
                                                </div>
                                                <span class="input-group-addon btn default btn-file">
        													<span class="fileinput-new">
        													Select file </span>
        													<span class="fileinput-exists">
        													Change </span>
        													<input type="file" name="cv">
        													</span>
                                                <a href="#" class="input-group-addon btn btn-sm red fileinput-exists"
                                                   data-dismiss="fileinput">
                                                    Remove </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Diplôme</label>
                                    <div class="col-md-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input" data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp; <span
                                                            class="fileinput-filename">
        														</span>
                                                </div>
                                                <span class="input-group-addon btn default btn-file">
        													<span class="fileinput-new">
        													Select file </span>
        													<span class="fileinput-exists">
        													Change </span>
        													<input type="file" name="diplome">
        													</span>
                                                <a href="#" class="input-group-addon btn btn-sm red fileinput-exists"
                                                   data-dismiss="fileinput">
                                                    Remove </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Carte nationale d'identité</label>
                                    <div class="col-md-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input" data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp; <span
                                                            class="fileinput-filename">
        														</span>
                                                </div>
                                                <span class="input-group-addon btn default btn-file">
        													<span class="fileinput-new">
        													Select file </span>
        													<span class="fileinput-exists">
        													Change </span>
        													<input type="file" name="cni">
        													</span>
                                                <a href="#" class="input-group-addon btn btn-sm red fileinput-exists"
                                                   data-dismiss="fileinput">
                                                    Remove </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Certificat de nationalité</label>
                                    <div class="col-md-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input" data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp; <span
                                                            class="fileinput-filename">
        														</span>
                                                </div>
                                                <span class="input-group-addon btn default btn-file">
        													<span class="fileinput-new">
        													Select file </span>
        													<span class="fileinput-exists">
        													Change </span>
        													<input type="file" name="cn">
        													</span>
                                                <a href="#" class="input-group-addon btn btn-sm red fileinput-exists"
                                                   data-dismiss="fileinput">
                                                    Remove </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Casier judiciaire</label>
                                    <div class="col-md-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input" data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp; <span
                                                            class="fileinput-filename">
        														</span>
                                                </div>
                                                <span class="input-group-addon btn default btn-file">
        													<span class="fileinput-new">
        													Select file </span>
        													<span class="fileinput-exists">
        													Change </span>
        													<input type="file" name="cj">
        													</span>
                                                <a href="#" class="input-group-addon btn btn-sm red fileinput-exists"
                                                   data-dismiss="fileinput">
                                                    Remove </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
								
								<div class="form-group">
                                    <label class="control-label col-md-2">Informations d'identité bancaire</label>
                                    <div class="col-md-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input" data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp; <span
                                                            class="fileinput-filename">
        														</span>
                                                </div>
                                                <span class="input-group-addon btn default btn-file">
        													<span class="fileinput-new">
        													Select file </span>
        													<span class="fileinput-exists">
        													Change </span>
        													<input type="file" name="iban">
        													</span>
                                                <a href="#" class="input-group-addon btn btn-sm red fileinput-exists"
                                                   data-dismiss="fileinput">
                                                    Remove </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
								
								<div class="form-group">
                                    <label class="control-label col-md-2">Carte d'IPRES</label>
                                    <div class="col-md-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input" data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp; <span
                                                            class="fileinput-filename">
        														</span>
                                                </div>
                                                <span class="input-group-addon btn default btn-file">
        													<span class="fileinput-new">
        													Select file </span>
        													<span class="fileinput-exists">
        													Change </span>
        													<input type="file" name="ipres">
        													</span>
                                                <a href="#" class="input-group-addon btn btn-sm red fileinput-exists"
                                                   data-dismiss="fileinput">
                                                    Remove </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
								
								<div class="form-group">
                                    <label class="control-label col-md-2">Certificat de mariage</label>
                                    <div class="col-md-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input" data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp; <span
                                                            class="fileinput-filename">
        														</span>
                                                </div>
                                                <span class="input-group-addon btn default btn-file">
        													<span class="fileinput-new">
        													Select file </span>
        													<span class="fileinput-exists">
        													Change </span>
        													<input type="file" name="cm">
        													</span>
                                                <a href="#" class="input-group-addon btn btn-sm red fileinput-exists"
                                                   data-dismiss="fileinput">
                                                    Remove </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
								
								<div class="form-group">
                                    <label class="control-label col-md-2">Livret de famille</label>
                                    <div class="col-md-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input" data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp; <span
                                                            class="fileinput-filename">
        														</span>
                                                </div>
                                                <span class="input-group-addon btn default btn-file">
        													<span class="fileinput-new">
        													Select file </span>
        													<span class="fileinput-exists">
        													Change </span>
        													<input type="file" name="lf">
        													</span>
                                                <a href="#" class="input-group-addon btn btn-sm red fileinput-exists"
                                                   data-dismiss="fileinput">
                                                    Remove </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
								
								<div class="form-group">
                                    <label class="control-label col-md-2">Certificat de bonne vie et de mœurs </label>
                                    <div class="col-md-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input" data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp; <span
                                                            class="fileinput-filename">
        														</span>
                                                </div>
                                                <span class="input-group-addon btn default btn-file">
        													<span class="fileinput-new">
        													Select file </span>
        													<span class="fileinput-exists">
        													Change </span>
        													<input type="file" name="cbm">
        													</span>
                                                <a href="#" class="input-group-addon btn btn-sm red fileinput-exists"
                                                   data-dismiss="fileinput">
                                                    Remove </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
								
								<div class="form-group">
                                    <label class="control-label col-md-2">Visite et contre visite</label>
                                    <div class="col-md-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input" data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp; <span
                                                            class="fileinput-filename">
        														</span>
                                                </div>
                                                <span class="input-group-addon btn default btn-file">
        													<span class="fileinput-new">
        													Select file </span>
        													<span class="fileinput-exists">
        													Change </span>
        													<input type="file" name="vcv">
        													</span>
                                                <a href="#" class="input-group-addon btn btn-sm red fileinput-exists"
                                                   data-dismiss="fileinput">
                                                    Remove </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix">
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="button" onclick="addEmployee()" class="btn green">
                                    <i class="fa fa-plus"></i> Submit
                                </button>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
            </div>

        </div>
        </form>
    @endif
    <hr>

@stop



@section('footerjs')


    <!-- BEGIN PAGE LEVEL PLUGINS -->
    {!! HTML::script('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') !!}
    {!! HTML::script('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') !!}
    {!! HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js") !!}
    {!! HTML::script('assets/admin/pages/scripts/components-pickers.js') !!}
    <!-- END PAGE LEVEL PLUGINS -->




    <script>
        jQuery(document).ready(function () {
            ComponentsPickers.init();
            dept();
        });

        function dept() {
            $.getJSON("{{ route('admin.departments.ajax_designation')}}",
                {deptID: $('#department').val()},
                function (data) {
                    var model = $('#designation');
                    model.empty();
                    $.each(data, function (index, element) {
                        model.append("<option value='" + element.id + "'>" + element.designation + "</option>");
                    });
                });
        }

        // Show Add Edit Function
        function addEmployee() {
            var url = "{{ route('admin.employees.store') }}";
            $.easyAjax({
                type: 'POST',
                url: url,
                container: "#addEmployeeForm",
                file: true
            });
        }

    </script>
@stop

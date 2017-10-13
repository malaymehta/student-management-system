<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            {!! Form::label('Name') !!}<span style="color:red;">*</span>
            {!! Form::text('name', isset($department)? $department->name : '', ['class'=>'form-control']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="form-group pull-right">
            {!! Form::submit(!empty($department) ? 'Update': 'Store', ['class'=>'btn btn-default']) !!}
        </div>
    </div>
</div>
<!--
/**
 * Created by PhpStorm.
 * User: Micheal Mueller - MuellerTek
 * Web: http://www.MuellerTek.com
 * Date: 4/11/2017, 7:02 PM

@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="col-md-4"></div>
            <div class="col-md-4">
              <p>To cancel your Subscription click the button below, once you cancel your subscription
              you will be on a grace period that will last till the end of the subscription.</p>

                <p>This just ensures that you will not be billed again at the end of the subscription.</p>
                <form>
                    <input type="submit" class="btn btn-danger" value="Cancel My Subscription">
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
@stop
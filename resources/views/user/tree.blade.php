@extends('admin.main')

@section('content')
<style>
    .mind-map {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
    }

    .node {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
    }

    .circle {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background-color: lightblue;
        text-align: center;
        line-height: 100px;
        position: relative;
        margin: 10px;
    }
    .circle1 {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background-color: rgb(230, 224, 173);
        text-align: center;
        line-height: 100px;
        position: relative;
        margin: 10px;
    }


    .parentcir {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background-color: darkcyan;
        text-align: center;
        line-height: 100px;
        position: relative;
        margin: 10px;
    }

    .no {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background: transparent;
        border: none;
        box-shadow: none;
        top: 0;
        left: 0;
    }

    .card-title {
        font-weight: bold;
        font-size: 18px;
        color: #fff;
    }

    .children {
        display: flex;

        position: relative;
    }


    .child {
        margin: 0 20px;
    }

    .node::before {
        content: "";
        position: absolute;
        width: 2px;
        background: #000;
        top: 0;
        left: 50px;
        bottom: 50px;
        z-index: -1;
    }
</style>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tree View</h4>
                        <p class="card-description"></p>
                        <div class="table-responsive">
                            <div class="mind-map">
                                @if ($user)
                                    <div class="node">
                                        <div class="circle parentcir">
                                            <div class="card no">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $user->name }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <h6 style="font-size: 12px;">{{$user->user_id}}</h6>

                                        @if (count($users) > 0)
                                        <div class="children">
                                                @foreach ($users as $key => $child)

                                                    <div class="node">
                                                        <div class="circle">
                                                            <div class="card no">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">{{ $child['name'] }}</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h6 style="font-size: 12px;">{{$child['user_id']}}</h6>




                                                     @if (count($child['next_level']) > 0)
                                                            <div class="children">
                                                                @foreach ($child['next_level'] as $subchild)
                                                                    <div class="child">
                                                                        <div class="circle1">
                                                                            <div class="card no">
                                                                                <div class="card-body">
                                                                                    <h5 class="card-title">{{ $subchild->name }}</h5>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <h6 style="font-size: 12px;">{{$subchild->user_id}}</h6>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endif

                                                    </div>

                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <center>
                                        <h4><i class="fas fa-exclamation-circle mt-5"></i> No Records Found</h4>
                                    </center>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection

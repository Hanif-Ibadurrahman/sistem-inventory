@if(session()->has('notification'))
  <div class="alert alert-{{session()->get('notification.type')}} alert-with-icon" data-notify="container">
      <!-- <button type="button" aria-hidden="true" class="close" >
          <i class="now-ui-icons ui-1_simple-remove"></i>
      </button> -->
      <span data-notify="icon" class="{{session()->get('notification.icon')}}"></span>
      <span data-notify="message">{{session()->get('notification.message')}}</span>
  </div>
@endif

<!-- @if(session()->has('notification'))
    color="{{session()->get('notification.type')}}",
        $.notify({
        icon:"{{session()->get('notification.icon')}}",
        message:"{{session()->get('notification.message')}}"
    },{
    type:color,
    timer:8e3,
    placement:{
        from:top,
        align:right
        }
    });
@endif -->

<!-- Session::flash('notification', [
            'type' => 'success',
            'icon' => 'now-ui-icons ui-1_check',
            'message' => 'Add Success'
        ]);
        // type : primary, info, success, warning, danger
        // icon : now-ui-icons ui-1_bell-53, now-ui-icons travel_info, now-ui-icons ui-1_check, now-ui-icons ui-1_simple-remove, now-ui-icons ui-2_settings-90
        // message : <strong></strong>, <b></b> -->

<!-- @if(session()->has('notification.message'))
  $.notify({
      icon: "{{session()->get('notification.icon')}}",
      message: "{{session()->get('notification.message')}}"

  },{
      type: "{{session()->get('notification.type')}}",
      timer: 2000,
      placement: {
          from: top,
          align: right
      }
  });
@endif -->

<!-- @if(Session::has('success'))
    <div class="alert alert-success">
        {{Session::get('success')}}
    </div>
@elseif(Session::has('fail'))
    <div class="alert alert-danger">
       {{Session::get('fail')}}
    </div>
@elseif(Session::has('warning'))
    <div class="alert alert-warning">
       {{Session::get('warning')}}
    </div>
@elseif(Session::has('info'))
    <div class="alert alert-info">
       {{Session::get('info')}}
    </div>
@endif -->
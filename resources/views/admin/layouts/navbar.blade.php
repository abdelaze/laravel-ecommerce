<header class="main-header">
  <!-- Logo -->
  <a href="index2.html" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>A</b>LT</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Admin</b>LTE</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

  @include('admin.layouts.menu')
  </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{admin()->user()->name}}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li class="treeview {{ active_menu('')[0] }}">
         <a href="#">
           <i class="fa fa-list"></i> <span>{{ trans('admin.dashboard') }}</span>
           <span class="pull-right-container">

           </span>
         </a>
         <ul class="treeview-menu" style="{{ active_menu('admin')[1] }}">
           <li class=""><a href="{{ aurl('') }}">
             <i class="fa fa-cog"></i> <span>{{ trans('admin.dashboard') }}</span>
             <span class="pull-right-container">
             </span>
           </a>
         </li>
         <li class=""><a href="{{ aurl('settings') }}">
           <i class="fa fa-cog"></i> <span>{{ trans('admin.settings') }}</span>
           <span class="pull-right-container">
           </span>
         </a>
       </li>
     </ul>
   </li>



       <!-- I make that active_menu()[0] because the function will return array -->
      <li class="active treeview" {{active_menu('admin')[0]}}>
       <a href="#">
          <i class="fa fa-dashboard"></i> <span>{{trans('admin.admin')}}</span>

        </a>
        <ul class="treeview-menu" style="{{active_menu('admin')[1]}}">

           <li><a href="{{aurl('admin')}}"><i class="fa fa-circle-o"></i>{{trans('admin.admin')}}</a></li>
         </ul>

      </li>

      <li class="active treeview" {{active_menu('users')[0]}}>
       <a href="#">
          <i class="fa fa-dashboard"></i> <span>{{trans('admin.users')}}</span>

        </a>
        <ul class="treeview-menu" style="{{active_menu('users')[1]}}">

           <li><a href="{{aurl('users')}}?level=user"><i class="fa fa-circle-o"></i>{{trans('admin.users')}}</a></li>
           <li><a href="{{aurl('users')}}?level=user"><i class="fa fa-circle-o"></i>{{trans('admin.user')}}</a></li>
           <li><a href="{{aurl('users')}}?level=company"><i class="fa fa-circle-o"></i>{{trans('admin.company')}}</a></li>
           <li><a href="{{aurl('users')}}?level=vendor"><i class="fa fa-circle-o"></i>{{trans('admin.vendor')}}</a></li>
         </ul>

      </li>


      <!-- I make that active_menu()[0] because the function will return array -->
     <li class="active treeview" {{active_menu('countries')[0]}}>
      <a href="#">
         <i class="fa fa-flag"></i><span>{{trans('admin.countries')}}</span>

       </a>
       <ul class="treeview-menu" style="{{active_menu('countries')[1]}}">

          <li><a href="{{aurl('countries')}}"><i class="fa fa-circle-o"></i>{{trans('admin.countries')}}</a></li>
          <li><a href="{{aurl('countries/create')}}"><i class="fa fa-circle-o"></i>{{trans('admin.add')}}</a></li>
      </ul>

     </li>



     <li class="active treeview" {{active_menu('cities')[0]}}>
      <a href="#">
         <i class="fa fa-flag"></i><span>{{trans('admin.cities')}}</span>

       </a>
       <ul class="treeview-menu" style="{{active_menu('cities')[1]}}">

          <li><a href="{{aurl('cities')}}"><i class="fa fa-circle-o"></i>{{trans('admin.cities')}}</a></li>
          <li><a href="{{aurl('cities/create')}}"><i class="fa fa-circle-o"></i>{{trans('admin.add')}}</a></li>
      </ul>

     </li>

     <li class="active treeview" {{active_menu('states')[0]}}>
      <a href="#">
         <i class="fa fa-flag"></i><span>{{trans('admin.states')}}</span>

       </a>
       <ul class="treeview-menu" style="{{active_menu('states')[1]}}">

          <li><a href="{{aurl('states')}}"><i class="fa fa-circle-o"></i>{{trans('admin.states')}}</a></li>
          <li><a href="{{aurl('states/create')}}"><i class="fa fa-circle-o"></i>{{trans('admin.add')}}</a></li>
      </ul>

     </li>


     <li class="active treeview" {{active_menu('departments')[0]}}>
      <a href="#">
         <i class="fa fa-dashboard"></i><span>{{trans('admin.departments')}}</span>

       </a>
       <ul class="treeview-menu" style="{{active_menu('departments')[1]}}">

          <li><a href="{{aurl('departments')}}"><i class="fa fa-circle-o"></i>{{trans('admin.departments')}}</a></li>
          <li><a href="{{aurl('departments/create')}}"><i class="fa fa-circle-o"></i>{{trans('admin.add')}}</a></li>
      </ul>

     </li>


     <li class="active treeview" {{active_menu('trademarks')[0]}}>
      <a href="#">
         <i class="fa fa-flag"></i><span>{{trans('admin.trademarks')}}</span>

       </a>
       <ul class="treeview-menu" style="{{active_menu('trademarks')[1]}}">

          <li><a href="{{aurl('trademarks')}}"><i class="fa fa-circle-o"></i>{{trans('admin.trademarks')}}</a></li>
          <li><a href="{{aurl('trademarks/create')}}"><i class="fa fa-circle-o"></i>{{trans('admin.add')}}</a></li>
      </ul>

     </li>


     <li class="active treeview" {{active_menu('manufacts')[0]}}>
      <a href="#">
         <i class="fa fa-flag"></i><span>{{trans('admin.manufacts')}}</span>

       </a>
       <ul class="treeview-menu" style="{{active_menu('manufacts')[1]}}">

          <li><a href="{{aurl('manufacts')}}"><i class="fa fa-circle-o"></i>{{trans('admin.manufacts')}}</a></li>
          <li><a href="{{aurl('manufacts/create')}}"><i class="fa fa-circle-o"></i>{{trans('admin.add')}}</a></li>
      </ul>

     </li>


     <li class="active treeview" {{active_menu('manufacts')[0]}}>
      <a href="#">
         <i class="fa fa-flag"></i><span>{{trans('admin.shipping')}}</span>

       </a>
       <ul class="treeview-menu" style="{{active_menu('shipping')[1]}}">

          <li><a href="{{aurl('shipping')}}"><i class="fa fa-circle-o"></i>{{trans('admin.shipping')}}</a></li>
          <li><a href="{{aurl('shipping/create')}}"><i class="fa fa-circle-o"></i>{{trans('admin.add')}}</a></li>
      </ul>

     </li>


     <li class="active treeview" {{active_menu('malls')[0]}}>
      <a href="#">
         <i class="fa fa-building"></i><span>{{trans('admin.malls')}}</span>

       </a>
       <ul class="treeview-menu" style="{{active_menu('malls')[1]}}">

          <li><a href="{{aurl('malls')}}"><i class="fa fa-building"></i>{{trans('admin.malls')}}</a></li>
          <li><a href="{{aurl('malls/create')}}"><i class="fa fa-circle-o"></i>{{trans('admin.add')}}</a></li>
      </ul>

     </li>


     <li class="active treeview" {{active_menu('colors')[0]}}>
      <a href="#">
         <i class="fa fa-paint-brush"></i><span>{{trans('admin.colors')}}</span>

       </a>
       <ul class="treeview-menu" style="{{active_menu('colors')[1]}}">

          <li><a href="{{aurl('colors')}}"><i class="fa fa-paint-brush"></i>{{trans('admin.colors')}}</a></li>
          <li><a href="{{aurl('colors/create')}}"><i class="fa fa-circle-o"></i>{{trans('admin.add')}}</a></li>
      </ul>

     </li>


     <li class="active treeview" {{active_menu('sizes')[0]}}>
      <a href="#">
         <i class="fa fa-info-circle"></i><span>{{trans('admin.sizes')}}</span>

       </a>
       <ul class="treeview-menu" style="{{active_menu('sizes')[1]}}">

          <li><a href="{{aurl('sizes')}}"><i class="fa fa-info-circle"></i>{{trans('admin.sizes')}}</a></li>
          <li><a href="{{aurl('sizes/create')}}"><i class="fa fa-info-circle"></i>{{trans('admin.add')}}</a></li>
      </ul>

     </li>

     <li class="active treeview" {{active_menu('weights')[0]}}>
      <a href="#">
         <i class="fa fa-info-circle"></i><span>{{trans('admin.weights')}}</span>

       </a>
       <ul class="treeview-menu" style="{{active_menu('weights')[1]}}">

          <li><a href="{{aurl('weights')}}"><i class="fa fa-info-circle"></i>{{trans('admin.weights')}}</a></li>
          <li><a href="{{aurl('weights/create')}}"><i class="fa fa-info-circle"></i>{{trans('admin.add')}}</a></li>
      </ul>

     </li>


     <li class="active treeview" {{active_menu('products')[0]}}>
      <a href="#">
         <i class="fa fa-tag"></i><span>{{trans('admin.products')}}</span>

       </a>
       <ul class="treeview-menu" style="{{active_menu('products')[1]}}">

          <li><a href="{{aurl('products')}}"><i class="fa fa-tag"></i>{{trans('admin.products')}}</a></li>
          <li><a href="{{aurl('products/create')}}"><i class="fa fa-plus"></i>{{trans('admin.add')}}</a></li>
      </ul>

     </li>


    </ul>
  </section>
  <!-- /.sidebar -->
</aside>

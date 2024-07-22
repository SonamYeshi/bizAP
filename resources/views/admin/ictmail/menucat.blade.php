<x-app-layout>
    <div class="py-12">
        @include('sidebar')
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">


         <form class="form-horizontal" role="form" method="POST" action="{{ route('update_menu_cat') }}">
         <input type="hidden" name="role" value="{{$roleid}}" >
          {{ csrf_field() }}
         <?php $m = count($pages);?> 
         <table class="table table-bordered table-striped table-hover">
          <?php 
          for ($n = 1; $n<=6; $n++) 
         {
          echo "<tr>";
          for ($i = $n; $i<=$m; $i=($i + 6))
            { 
              ?>
              <td> <ul><li style="list-style-type: none;">
               <?php $cid = App\Models\tbl_menu::where('series', $i)->value('id'); ?>     
                  <input type="checkbox" value="<?php echo $cid; ?>" name="pages[]"
                  <?php 
                  $pages = App\Models\tbl_menu_category::where('role', $roleid)->value('pages');
                  $HiddenProducts = explode(',',$pages);
                  if (in_array($cid, $HiddenProducts)) { ?>checked="checked"<?php
                  } else { }
                  ?>
                  >
                  <span class="text"><?php echo $menu = App\Models\tbl_menu::where('series', $i)->value('menu_category'); ?></span>                  
                </li></ul>
                </td>
              <?php
            }
           echo "</tr>";}?>
         </table>

         
         <input type="hidden" name="edit_id_1" id='edit_id_1'>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-sm">Update</button>
            <a href="{{ route('view_role') }}">
            <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Cancel</button>
            </a>
          </div>
         </form>
      


        </div>
        </div>
    </div>
</x-app-layout>





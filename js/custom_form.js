/* 
 * Copyright (C) 2017 Guy-Jr.
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301  USA
 */

$(document).ready(function() {
    var max_fields      = 50;
    var wrapper         = $(".container1");
    var add_button      = $(".add_form_field");
  
    var x = 1;
    $(add_button).click(function(e){
        e.preventDefault();
        if(x < max_fields){
            x++;
            $(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="delete">Delete</a></div>'); //add input box
        }
  else
  {
  alert('Limite atteinte')
  }
    });
  
    $(wrapper).on("click",".delete", function(e){
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});

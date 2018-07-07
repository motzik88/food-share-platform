var placeSearch;
var autocomplete;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',

};

function initAutocomplete($ID) {
  // Create the autocomplete object, restricting the search to geographical
  // location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {!HTMLInputElement} */(document.getElementById($ID)),
      { types: ['address'] });

  autocomplete.addListener('place_changed', fillInAddress);

  // When the user selects an address from the dropdown, populate the address
  // fields in the form.

}

function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
      document.getElementById(component).disabled = false;
    }
  }
}

function shippingJS() {
  if ((document.getElementById(pickupRadio).checked = true) == 1) {
    document.getElementById(addressOrderInput).style.display = none;
    document.getElementById('autocompleteOrder').removeAttribute('required');
  }else {
    document.getElementById(addressOrderInput).style.display = block;
    document.getElementById('autocompleteOrder').setAttribute('required', '');
  }
}

$(document).ready(function () {
  $('#advText').click(function () {
    if (!$('#advSearch').is(':visible')) {
      $('#advSearch').css('display', 'block');
      $('#firstSearchButton').css('display', 'none');
      $('#isAdvSearch').value = 'yes';
    }else {
      $('#advSearch').css('display', 'none');
      $('#firstSearchButton').css('display', 'block');
      $('#isAdvSearch').value = 'no';
    }
  });
});

//Back to top function
var amountScrolled = 150;

$(window).scroll(function () {
    if ($(window).scrollTop() > amountScrolled) {
      $('a.back-to-top').fadeIn('slow');
    } else {
      $('a.back-to-top').fadeOut('slow');
    }
  });

$('a.back-to-top').click(function () {
    $('html, body').animate({ scrollTop: 0 }, 700);
    return false;
  });

//contant
function checkContact() {
  var fname = document.getElementById("fname").value;
  for (var i = 0; i < fname.length; i++)
  {
    if (!isNaN(fname.charAt(i)) && !(fname.charAt(i) == " "))
    {
      document.getElementById("fname").value = "";
      alert('נא הזן שנית את שמך הפרטי ללא מספרים');
      {
        break;
      }
    }

    textFname = fname.charAt(i);
  }
}

function checkFildes() {
  var fname = document.getElementById("First_Name").value;
  var i;
  for (i = 0; i < fname.length; i++)
    {
    if (!isNaN(fname.charAt(i)) && !(fname.charAt(i) == " "))//The isNaN() function returns true if the value is NaN (Not-a-Number),
    {
      document.getElementById("First_Name").value = "";
      alert('נא הזן שנית את שמך הפרטי ללא מספרים');
      {
        break;
      }
    }

    textFname = fname.charAt(i);
  }

  var lname = document.getElementById("last_Name").value;
  var j;
  for (j = 0; j < lname.length; j++)
  {
    if (!isNaN(lname.charAt(j)) && !(lname.charAt(j) == " "))
    {
      document.getElementById("last_Name").value = "";
      alert('נא הזן שנית את שם המשפחה  ללא מספרים');
      {
        break;
      }
    }
    textLname = lname.charAt(j);
  }
}

//Open menu in home page
$(document).ready(function () {
    var openMenuWidth = $(".open_menu_container").width();
    $(".open_menu_container").mouseenter(function () {
        $(this).animate({width: "123%"});
        $(this).children(".open_me").fadeIn(400);
    }).mouseleave(function () {
        $(this).animate({width: openMenuWidth});
        $(this).children(".open_me").fadeOut(400);
    });
});

//Log in drop down
$(document).ready(function () {
    $('.active-links').click(function () {
      //Conditional states allow the dropdown box appear and disappear
    if ($('#signin-dropdown').is(":visible")) {
        $('#signin-dropdown').hide();
        $('#signin-link').removeClass('active'); // When the dropdown is not visible removes the class "active"
        $('#enter_pos').css({"background-color": "transparent", "color": "white", "border-top": "none", "border-bottom": "none"});
        $('#enter_pos').hover(function () {
            $(this).css({"background-color": "transparent", "color": "white", "border-top": "2px solid orange", "border-bottom": "2px solid orange"});
        }, function () {
            $(this).css({"background-color": "transparent", "color": "white", "border-top": "none", "border-bottom": "none"});
        });
    } else {
        $('#signin-dropdown').show();
        $('#signin-link').addClass('active'); // When the dropdown is visible add class "active"
        $('#enter_pos').css({"background-color": "transparent", "color": "#33ff00", "border-top": "2px solid orange", "border-bottom": "2px solid orange"});
        $('#enter_pos').hover(function () {
            $(this).css({"background-color": "transparent", "color": "#33ff00", "border-top": "2px solid orange", "border-bottom": "2px solid orange"});
        });
    }
        return false;
    });
    $('#signin-dropdown').click(function (e) {
        e.stopPropagation();
    });
    $(document).click(function () {
        $('#signin-dropdown').hide();
        $('#enter_pos').removeClass('active');
        $('#enter_pos').css({"background-color": "transparent", "color": "white", "border-top": "none", "border-bottom": "none"});
        $('#enter_pos').hover(function () {
            $(this).css({"background-color": "transparent", "color": "white", "border-top": "2px solid orange", "border-bottom": "2px solid orange"});
        }, function () {
            $(this).css({"background-color": "transparent", "color": "white", "border-top": "none", "border-bottom": "none"});
        });
    });

});

//change remove value to remove order from database
function changeValue(id) {
    document.getElementById(id).value = id;
}

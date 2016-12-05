$(document).ready(function(){
  $('#alertt').fadeIn(500).delay(2000).fadeOut(500);
  $('#testjaa').submit(function(){
    var x = $('#ooo').text()
    alert(x)
    $.ajax({
      type:"POST",
      url:"{{ route('jajajaa') }}",
      data:{x:x,_token:  "{{ Session::token() }}"},
      success:function(data){
        alert(data)
      }
    });
    return false;
  });
  $('#clear').click(function(e){
    $('.showw1').empty();
    $('#show2').empty();
    $('#show3').empty();
    $('#show4').empty();
    $('#show').empty();
    var cha = $('.oo').val();
    $('#search').val('');
    if(cha==null)
      cha=0;
    console.log('delete '+cha);
    $.ajax("/classroom/aj/"+cha).done(function(data){
      console.log(data);
      $('.shower').text(data);
      $('.shower').empty();
      for(i in data){
        $('.shower').append('<div class="list-group-item bb" onclick="detail(\'' + data[i].code + '\')" style="margin-top:7px;margin-left:8px;cursor:hand;font-size:15px;">'+data[i].code+'<br>'+data[i].name+'</div>')
      }
    });
  });
  $('select').on('change', function(e) {
    $('#search').val('');
    $('.showw1').empty();
    $('#show2').empty();
    $('#show3').empty();
    $('#show4').empty();
    $('#show').empty();
    //console.log($('.oo').val())
    var chaa="";
    var xx = e.target.value;
    console.log('number '+e.target.value);
    if(xx==0)  //เช็คตอนย้อนกลับไปALL ตอนเลือกคณะแล้ว
      xx = $('select').val();
    if($('select').val()==0)  //แช็คให้้เลือกภาคเด้งไปเริ่มต้น
      $('.oo').empty();
    $.ajax( '/classroom/fill/'+ xx+'/'+chaa).done(function(data){
      //console.log(data);
      $('.shower').text(data);
      $('.shower').empty();
      for(i in data){
        $('.shower').append('<div class="list-group-item bb" onclick="detail(\'' + data[i].code+ '\')"style="margin-top:7px;margin-left:8px;cursor:hand;font-size:15px;">'+data[i].code+'<br>'+data[i].name+'</div>')
      }
      if(xx==01){
        $('.oo').empty();
        $('.oo').append('<option value="01">'+'All'+'</option>')
        $('.oo').append('<option value="0100">'+'เครื่องกลและการบินอวกาศ'+'</option>')
        $('.oo').append('<option value="0101">'+'ไฟฟ้าและคอมพิวเตอร์'+'</option>')
        $('.oo').append('<option value="0102">'+'การผลิต'+'</option>')
        $('.oo').append('<option value="0103">'+'เคมี'+'</option>')
        $('.oo').append('<option value="0105">'+'ขนถ่ายวัสดุโลจิสติก'+'</option>')
        $('.oo').append('<option value="0106">'+'วัสดุและเทคโนโลยีการผลิต'+'</option>')
        $('.oo').append('<option value="0107">'+'เครื่องมือวัดและอิเลก'+'</option>')
        $('.oo').append('<option value="0108">'+'โยธา'+'</option>')
        $('.oo').append('<option value="0109">'+'อุตสาหการ'+'</option>')
      }
      else if(xx==02){
        $('.oo').empty();
        $('.oo').append('<option value="02">'+'All'+'</option>')
        $('.oo').append('<option value="0201">'+'ครุศาสตร์เครื่องกล'+'</option>')
        $('.oo').append('<option value="0202">'+'ครุศาสตร์ไฟฟ้า'+'</option>')
        $('.oo').append('<option value="0203">'+'ครุศาสตร์โยธา'+'</option>')
        $('.oo').append('<option value="0204">'+'คอมพิวเตอร์ศึกษา'+'</option>')
        $('.oo').append('<option value="0205">'+'ครุรุศาสตรเทคโนโลยี'+'</option>')
        $('.oo').append('<option value="0206">'+'บริการเทคนิคศึกษา'+'</option>')
        $('.oo').append('<option value="0207">'+'บริหารธุรกิจอุตสาหกรรม'+'</option>')
        $('.oo').append('<option value="0299">'+'ไรไม่รุ้'+'</option>')
      }
      else if(xx==03){
        $('.oo').empty();
        $('.oo').append('<option value="03">'+'All'+'</option>')
        $('.oo').append('<option value="0300">'+'เทคโนโลยีศิลปอุตสาหกรรม'+'</option>')
        $('.oo').append('<option value="0301">'+'เทคโนโลยีวิศวกรรมเครื่องกล'+'</option>')
        $('.oo').append('<option value="0302">'+'เทคโนโลยีวิศวกรรมเครื่องต้นกำลัง'+'</option>')
        $('.oo').append('<option value="0303">'+'เทคโนโลยีวิศวกรรมการเชื่อม'+'</option>')
        $('.oo').append('<option value="0304">'+'เทคโนโลยีวิศวกรรมไฟฟ้า'+'</option>')
        $('.oo').append('<option value="0305">'+'เทคโนโลยีวิศวกรรมอิเล็กทรอนิกส์'+'</option>')
        $('.oo').append('<option value="0306">'+'เทคโนโลยีวิศวกรรมโยธาและสิ่งแวดล้อม'+'</option>')
        $('.oo').append('<option value="0307">'+'เทคโนโลยีวิศวกรรมอุตสาหการ'+'</option>')
        $('.oo').append('<option value="0308">'+'การจัดการเทคโนโลยีฯ'+'</option>')
        $('.oo').append('<option value="0308">'+'วิทยาศาสตร์ประยุกต์และสังคม'+'</option>')
        $('.oo').append('<option value="0310">'+'โรงเรียนเตรียมวิศวกรรมศาสตร์ฯ'+'</option>')
      }
      else if(xx==04){
        $('.oo').empty();
        $('.oo').append('<option value="04">'+'All'+'</option>')
        $('.oo').append('<option value="0401">'+'เคมีอุตสาหกรรม'+'</option>')
        $('.oo').append('<option value="0402">'+'คณิตศาสตร์'+'</option>')
        $('.oo').append('<option value="0403">'+'ฟิสิกส์อุตสาหกรรมและอุปกรณ์การแพทย์'+'</option>')
        $('.oo').append('<option value="0404">'+'เทคโนโลยีอุตสาหกรรมเกษตร อาหาร'+'</option>')
        $('.oo').append('<option value="0405">'+'สถิติประยุกต์'+'</option>')
        $('.oo').append('<option value="0406">'+'วิทยาการคอมพิวเตอร์และสารสนเทศ'+'</option>')
        $('.oo').append('<option value="0407">'+'เทคโนโลยีชีวภาพ'+'</option>')
      }
      else if(xx==05){
        $('.oo').empty();
        $('.oo').append('<option value="05">'+'All'+'</option>')
        $('.oo').append('<option value="0501">'+'เทคโนโลยีอุตสาหกรรมเกษตรและการจัดการ'+'</option>')
        $('.oo').append('<option value="0502">'+'พัฒนาผลิตภัณฑ์อุตสาหกรรมเกษตร'+'</option>')
        $('.oo').append('<option value="0503">'+'นวัตกรรมและเทคโนโลยีการพัฒนาผลิตภัณฑ์์'+'</option>')
      }
      else if(xx==06){
        $('.oo').empty();
        $('.oo').append('<option value="06">'+'All'+'</option>')
        $('.oo').append('<option value="0601">'+'การจัดการอุตสาหกรรม'+'</option>')
        $('.oo').append('<option value="0602">'+'เทคโนโลยีสารสนเทศ'+'</option>')
        $('.oo').append('<option value="0603">'+'เทคโนโลยีการออกแบบผลิตภัณฑ์และ'+'</option>')
        $('.oo').append('<option value="0604">'+'เทคโนโลยีการออกแบบและผลิตจักรกล'+'</option>')
        $('.oo').append('<option value="0605">'+'การจัดการอุตสาหกรรมการท่องเที่ยว'+'</option>')
      }
      else if(xx==07){
        $('.oo').empty();
        $('.oo').append('<option value="07">'+'All'+'</option>')
        $('.oo').append('<option value="0701">'+'เทคโนโลยีสารสนเทศ'+'</option>')
        $('.oo').append('<option value="0702">'+'การจัดการเทคโนโลยีสารสนเทศ'+'</option>')
        $('.oo').append('<option value="0703">'+'การสื่อสารข้อมูลและเครือข่าย'+'</option>')
      }
      else if(xx==08){
        $('.oo').empty();
        $('.oo').append('<option value="08">'+'All'+'</option>')
        $('.oo').append('<option value="0801">'+'ภาษา'+'</option>')
        $('.oo').append('<option value="0802">'+'สังคมศาสตร์'+'</option>')
        $('.oo').append('<option value="0803">'+'มนุษยศาสตร์'+'</option>')
      }
    });
  });
  $('#search').on('input',function(){

    var xx = $('.oo').val();
    var vv = $('select').val();
    var cha = $('#search').val();
    var pattern = /^[a-zA-Z0-9]+$/;
    var result = pattern.test(cha);
    if (!result){
      console.log('thainaja')
      cha='+';
    }
    $('.showw1').empty();
    $('#show2').empty();
    $('#show3').empty();
    $('#show4').empty();
    $('#show').empty();
    if(xx==null)  //เช็คให้ค่าเปน 0 เพราะ เราต้องเอา 0 จาก select มาใช้
      xx=0;
    console.log('value '+xx);




      if(xx==0){  //กรองอันแรก
        console.log('yes')


        $.ajax( '/classroom/fill/'+ vv+'/'+cha).done(function(data){
          //console.log(data);
          $('.shower').text(data);
          $('.shower').empty();
          for(i in data){
            $('.shower').append('<div class="list-group-item bb" onclick="detail(\'' + data[i].code+ '\')"style="margin-top:7px;margin-left:8px;cursor:hand;font-size:15px;">'+data[i].code+'<br>'+data[i].name+'</div>')
          }
        });
        }
        else{  //กรองอันแรกและอันสอง
          console.log('no')
          $.ajax( '/classroom/fill/'+ xx+'/'+cha).done(function(data){
            //console.log(data);
            $('.shower').text(data);
            $('.shower').empty();
            for(i in data){
              $('.shower').append('<div class="list-group-item bb" onclick="detail(\'' + data[i].code+ '\')"style="margin-top:7px;margin-left:8px;cursor:hand;font-size:15px;">'+data[i].code+'<br>'+data[i].name+'</div>')
            }
          });
        }

  });


});
function detail(data){
  $('#commentclass').val('');
  $.ajax( "/classroom/ajax/"+ data).done(function(data){
    $('#show').html('<b>'+data.code+'<b>'+'<br>'+'<b >'+data.name+'</b>');
    $('#show2').html(data.name);
    $('#show3').html(data.code);
    $('#show4').html(data.w);
  });
  $.ajax( "/classroom/aja/"+ data).done(function(data){
    $('.showw1').text(data)
    $('.showw1').empty();
    for(i in data){
      $('.showw1').append(
      '<div data-toggle="modal" data-target="#showdetail" onclick="ccc(\'' + data[i].code+ '\')" class="list-group-item box-detail" style="margin-top:7px;margin-left:8px;cursor:hand;font-size:15px;">'
        +'<div class="box-left size-text-left">'+'</b>'+'<b id="section_number">'+data[i].section+'</b>'+'</div>'
        +'<div class="box-right">'+'<b id="ggg">'+data[i].code+'<b>'+' Day : '+'</b>'+data[i].day+'<b>'+' Time : '+'</b>'+data[i].time+'</b>'+'<b>'+' Profressor : '+'</b>'+data[i].prof
        +'<b>'+' Seat : '+'</b>'+data[i].n+'<b>'+' Owner : '+'</b>'+data[i].owner+'<b>'+' Room : '+'</b>'+data[i].room+'</div>'
      +'</div>');

    }

  });
}
function ccc(data){
  $('#addddd').html(data)
}

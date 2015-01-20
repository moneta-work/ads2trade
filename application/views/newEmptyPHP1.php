<script>
function calcu(b){

var perc;
var bb;
var bus;
var myval;
var res;
var str;
 bb = document.getElementById('sizes').value;

if ( b == 0 ){

 bus =  document.getElementById('involved_in').value;

if ( bus == 'conf1' ){
str = document.getElementById('invest_amt_cap').value;
res = mask(str);
res = res * 1;
  switch(bb)
{
  case 'SIZE1':
if (( document.getElementById('ind1_cap1').value  * 1 ) > res && ( res != 0 )   ){
alert("Own investment amount cannot be less than the minimum investment amount");


}
 myval = (( document.getElementById('ind1_capp1').value * 1 ) * ( res * 1 ) / 100 );
if ( myval > ( document.getElementById('ind1_capx1').value  * 1 ) ){
myval = ( document.getElementById('ind1_capx1').value * 1 );

}
  break;

  case 'SIZE2':
  if (( document.getElementById('ind1_cap2').value  * 1 ) > res  && ( res != 0 ) ){
  alert("Own investment amount cannot be less than the minimum investment amount");

}
  myval = (( document.getElementById('ind1_capp2').value * 1 ) * ( res * 1 ) / 100 );
  if ( myval > ( document.getElementById('ind1_capx2').value  * 1 ) ){
myval = ( document.getElementById('ind1_capx2').value * 1 );

}
  break;
  case 'SIZE3':
    if (( document.getElementById('ind1_cap3').value  * 1 ) > res && ( res != 0 ) ){
    alert("Own investment amount cannot be less than the minimum investment amount");

}
  myval = (( document.getElementById('ind1_capp3').value * 1 ) * ( res * 1 ) / 100 );
if ( myval > ( document.getElementById('ind1_capx3').value  * 1 ) ){
myval = ( document.getElementById('ind1_capx3').value * 1 );

}
 break;
  case 'SIZE4':
    if (( document.getElementById('ind1_cap4').value  * 1 ) > res && ( res != 0 ) ){
    alert("Own investment amount cannot be less than the minimum investment amount");

}
  myval = (( document.getElementById('ind1_capp4').value * 1 ) * ( res * 1 ) / 100 );
  if ( myval > ( document.getElementById('ind1_capx4').value  * 1 ) ){
myval = ( document.getElementById('ind1_capx4').value * 1 );

}
  break;
}
sum = myval + ( (document.getElementById('est_dti_feh').value * 1 ) + (document.getElementById('est_dti_enth').value * 1 )  + (document.getElementById('est_dti_greh').value * 1 ) ) ;
gelih = document.getElementById('GV_ELIG_AVAIL_AMT1h').value * 1 ;
geli = document.getElementById('geam').value * 1 ;
var diff = ( geli - sum  ) ;


 document.getElementById('est_dti_cap').value =  formats(myval);
 document.getElementById('est_dti_caph').value = myval;
 document.getElementById('invest_amt_cap').value = formats( res * 1 );
 document.getElementById('GV_ELIG_AVAIL_AMT1h').value = (geli - myval) ;
 document.getElementById('GV_ELIG_AVAIL_AMT1').value = formats(geli - sum);

}

if ( bus == 'ind1' ){
str = document.getElementById('invest_amt_cap').value;
res = mask(str);
res = res * 1;
  switch(bb)
{
  case 'SIZE1':
if (( document.getElementById('ind1_cap1').value  * 1 ) > res && ( res != 0 )   ){
alert("Own investment amount cannot be less than the minimum investment amount");


}
 myval = (( document.getElementById('ind1_capp1').value * 1 ) * ( res * 1 ) / 100 );
if ( myval > ( document.getElementById('ind1_capx1').value  * 1 ) ){
myval = ( document.getElementById('ind1_capx1').value * 1 );

}
  break;

  case 'SIZE2':
  if (( document.getElementById('ind1_cap2').value  * 1 ) > res  && ( res != 0 ) ){
  alert("Own investment amount cannot be less than the minimum investment amount");

}
  myval = (( document.getElementById('ind1_capp2').value * 1 ) * ( res * 1 ) / 100 );
  if ( myval > ( document.getElementById('ind1_capx2').value  * 1 ) ){
myval = ( document.getElementById('ind1_capx2').value * 1 );

}
  break;
  case 'SIZE3':
    if (( document.getElementById('ind1_cap3').value  * 1 ) > res && ( res != 0 ) ){
    alert("Own investment amount cannot be less than the minimum investment amount");

}
  myval = (( document.getElementById('ind1_capp3').value * 1 ) * ( res * 1 ) / 100 );
if ( myval > ( document.getElementById('ind1_capx3').value  * 1 ) ){
myval = ( document.getElementById('ind1_capx3').value * 1 );

}
 break;
  case 'SIZE4':
    if (( document.getElementById('ind1_cap4').value  * 1 ) > res && ( res != 0 ) ){
    alert("Own investment amount cannot be less than the minimum investment amount");

}
  myval = (( document.getElementById('ind1_capp4').value * 1 ) * ( res * 1 ) / 100 );
  if ( myval > ( document.getElementById('ind1_capx4').value  * 1 ) ){
myval = ( document.getElementById('ind1_capx4').value * 1 );

}
  break;
}
sum = myval + ( (document.getElementById('est_dti_feh').value * 1 ) + (document.getElementById('est_dti_enth').value * 1 )  + (document.getElementById('est_dti_greh').value * 1 ) ) ;
gelih = document.getElementById('GV_ELIG_AVAIL_AMT1h').value * 1 ;
geli = document.getElementById('geam').value * 1 ;
var diff = ( geli - sum  ) ;


 document.getElementById('est_dti_cap').value =  formats(myval);
 document.getElementById('est_dti_caph').value = myval;
 document.getElementById('invest_amt_cap').value = formats( res * 1 );
 document.getElementById('GV_ELIG_AVAIL_AMT1h').value = (geli - myval) ;
 document.getElementById('GV_ELIG_AVAIL_AMT1').value = formats(geli - sum);

}
if ( bus == 'ma1' ){
str = document.getElementById('invest_amt_cap').value;
res = mask(str);
res = res * 1.
 switch(bb)
{
  case 'SIZE1':
    if (( document.getElementById('ma1_cap1').value  * 1 ) > res && ( res != 0 ) ){
    alert("Own investment amount cannot be less than the minimum investment amount");

}
 myval = (( document.getElementById('ma1_capp1').value * 1 ) * ( res * 1 ) / 100 );
 if ( myval > ( document.getElementById('ma1_capx1').value  * 1 ) ){
myval = ( document.getElementById('ma1_capx1').value * 1 );

}
  break;
  case 'SIZE2':
    if (( document.getElementById('ma1_cap2').value  * 1 ) > res && ( res != 0 ) ){
    alert("Own investment amount cannot be less than the minimum investment amount");

}
  myval = (( document.getElementById('ma1_capp2').value * 1 ) * ( res * 1 ) / 100 );
  if ( myval > ( document.getElementById('ma1_capx2').value  * 1 ) ){
myval = ( document.getElementById('ma1_capx2').value * 1 );

}
  break;
  case 'SIZE3':
    if (( document.getElementById('ma1_cap3').value  * 1 ) > res && ( res != 0 ) ){
    alert("Own investment amount cannot be less than the minimum investment amount");
document.getElementById('invest_amt_cap').focus();
}
  myval = (( document.getElementById('ma1_capp3').value * 1 ) * ( res * 1 ) / 100 );
  if ( myval > ( document.getElementById('ma1_capx3').value  * 1 ) ){
myval = ( document.getElementById('ma1_capx3').value * 1 );

}

 break;
  case 'SIZE4':
    if (( document.getElementById('ma1_cap4').value  * 1 ) > res && ( res != 0 ) ){
    alert("Own investment amount cannot be less than the minimum investment amount");

}
  myval = (( document.getElementById('ma1_capp4').value * 1 ) * ( res * 1 ) / 100 );
  if ( myval > ( document.getElementById('ma1_capx4').value  * 1 ) ){
myval = ( document.getElementById('ma1_capx4').value * 1 );

}
  break;
}
sum = myval + ( (document.getElementById('est_dti_feh').value * 1 ) + (document.getElementById('est_dti_enth').value * 1 )  + (document.getElementById('est_dti_greh').value * 1 ) ) ;
gelih = document.getElementById('GV_ELIG_AVAIL_AMT1h').value * 1 ;
geli = document.getElementById('geam').value * 1 ;
var diff = ( geli - sum  ) ;


 document.getElementById('est_dti_cap').value =  formats(myval);
 document.getElementById('est_dti_caph').value = myval;
 document.getElementById('invest_amt_cap').value = formats( res * 1 );
 document.getElementById('GV_ELIG_AVAIL_AMT1h').value = (geli - myval) ;
 document.getElementById('GV_ELIG_AVAIL_AMT1').value = formats(geli - sum);


 }
}

if ( b == 1 ){
bus =  document.getElementById('involved_in').value;
if ( bus == 'ind1' ){
str = document.getElementById('invest_amt_gre').value;
res = mask(str);
  switch(bb)
{
  case 'SIZE1':
  if (( document.getElementById('ind1_gre1').value  * 1 ) > res && ( res != 0 ) ){
  alert("Own investment amount cannot be less than the minimum investment amount");

}
 myval = (( document.getElementById('ind1_grep1').value * 1 ) * ( res * 1 ) / 100 );
 if ( myval > ( document.getElementById('ind1_grex1').value  * 1 ) ){
myval = ( document.getElementById('ind1_grex1').value * 1 );

}
  break;
  case 'SIZE2':
   if (( document.getElementById('ind1_gre2').value  * 1 ) > res && ( res != 0 ) ){
   alert("Own investment amount cannot be less than the minimum investment amount");

}
  myval = (( document.getElementById('ind1_grep2').value * 1 ) * ( res * 1 ) / 100 );
   if ( myval > ( document.getElementById('ind1_grex2').value  * 1 ) ){
myval = ( document.getElementById('ind1_grex2').value * 1 );

}
  break;
  case 'SIZE3':
    if (( document.getElementById('ind1_gre3').value  * 1 ) > res && ( res != 0 ) ){
    alert("Own investment amount cannot be less than the minimum investment amount");

}
  myval = (( document.getElementById('ind1_grep3').value * 1 ) * ( res * 1 ) / 100 );
   if ( myval > ( document.getElementById('ind1_grex3').value  * 1 ) ){
myval = ( document.getElementById('ind1_grex3').value * 1 );

}
 break;
  case 'SIZE4':
    if (( document.getElementById('ind1_gre4').value  * 1 ) > res && ( res != 0 ) ){
    alert("Own investment amount cannot be less than the minimum investment amount");

}
  myval = (( document.getElementById('ind1_grep4').value * 1 ) * ( res * 1 ) / 100 );
  if ( myval > ( document.getElementById('ind1_grex4').value  * 1 ) ){
myval = ( document.getElementById('ind1_grex4').value * 1 );

}
  break;
}
sum = myval + ( (document.getElementById('est_dti_feh').value * 1 ) + (document.getElementById('est_dti_enth').value * 1 ) + (document.getElementById('est_dti_caph').value * 1 ) ) ;
gelih = document.getElementById('GV_ELIG_AVAIL_AMT1h').value * 1 ;
geli = document.getElementById('geam').value * 1 ;
var diff = ( geli - sum  ) ;


 document.getElementById('est_dti_gre').value =  formats(myval);
 document.getElementById('est_dti_greh').value = myval;
 document.getElementById('invest_amt_gre').value = formats( res * 1 );
 document.getElementById('GV_ELIG_AVAIL_AMT1h').value = (geli - myval) ;
 document.getElementById('GV_ELIG_AVAIL_AMT1').value = formats(geli - sum);

}else{
str = document.getElementById('invest_amt_gre').value;
res = mask(str);
 switch(bb)
{
  case 'SIZE1':
  if (( document.getElementById('ma1_gre1').value  * 1 ) > res && ( res != 0 ) ){
  alert("Own investment amount cannot be less than the minimum investment amount");

}
 myval = (( document.getElementById('ma1_grep1').value * 1 ) * ( res * 1 ) / 100 );
 if ( myval > ( document.getElementById('ma1_grex1').value  * 1 ) ){
myval = ( document.getElementById('ma1_grex1').value * 1 );

}
  break;
  case 'SIZE2':
   if (( document.getElementById('ma1_gre2').value  * 1 ) > res && ( res != 0 ) ){
   alert("Own investment amount cannot be less than the minimum investment amount");

}
  myval = (( document.getElementById('ma1_grep2').value * 1 ) * ( res * 1 ) / 100 );
  if ( myval > ( document.getElementById('ma1_grex2').value  * 1 ) ){
myval = ( document.getElementById('ma1_grex2').value * 1 );

}
  break;
  case 'SIZE3':
   if (( document.getElementById('ma1_gre3').value  * 1 ) > res && ( res != 0 ) ){
   alert("Own investment amount cannot be less than the minimum investment amount");

}
  myval = (( document.getElementById('ma1_grep3').value * 1 ) * ( res * 1 ) / 100 );
  if ( myval > ( document.getElementById('ma1_grex3').value  * 1 ) ){
myval = ( document.getElementById('ma1_grex3').value * 1 );

}
 break;
  case 'SIZE4':
   if (( document.getElementById('ma1_gre4').value  * 1 ) > res && ( res != 0 ) ){
   alert("Own investment amount cannot be less than the minimum investment amount");

}
  myval = (( document.getElementById('ma1_grep4').value * 1 ) * ( res * 1 ) / 100 );
  if ( myval > ( document.getElementById('ma1_grex4').value  * 1 ) ){
myval = ( document.getElementById('ma1_grex4').value * 1 );

}
  break;
}
sum = myval + ( (document.getElementById('est_dti_feh').value * 1 ) + (document.getElementById('est_dti_enth').value * 1 ) + (document.getElementById('est_dti_caph').value * 1 ) ) ;
gelih = document.getElementById('GV_ELIG_AVAIL_AMT1h').value * 1 ;
geli = document.getElementById('geam').value * 1 ;
var diff = ( geli - sum  ) ;


 document.getElementById('est_dti_gre').value = formats(myval);
 document.getElementById('est_dti_greh').value = myval;
  document.getElementById('invest_amt_gre').value = formats( res * 1 );
   document.getElementById('GV_ELIG_AVAIL_AMT1h').value = (geli - myval) ;
 document.getElementById('GV_ELIG_AVAIL_AMT1').value = formats(geli - sum);

 }

}

if ( b == 2 ){
bus =  document.getElementById('involved_in').value;
if ( bus == 'ind1' ){
str = document.getElementById('invest_amt_ent').value;
res = mask(str);
  switch(bb)
{
  case 'SIZE1':
   if (( document.getElementById('ind1_ent1').value  * 1 ) > res && ( res != 0 ) ){
   alert("Own investment amount cannot be less than the minimum investment amount");

}
 myval = (( document.getElementById('ind1_entp1').value * 1 ) * ( res * 1 ) / 100 );
 if ( myval > ( document.getElementById('ind1_entx1').value  * 1 ) ){
myval = ( document.getElementById('ind1_entx1').value * 1 );

}
  break;
  case 'SIZE2':
    if (( document.getElementById('ind1_ent2').value  * 1 ) > res && ( res != 0 ) ){
    alert("Own investment amount cannot be less than the minimum investment amount");

}
  myval = (( document.getElementById('ind1_entp2').value * 1 ) * ( res * 1 ) / 100 );
   if ( myval > ( document.getElementById('ind1_entx2').value  * 1 ) ){
myval = ( document.getElementById('ind1_entx2').value * 1 );

}
  break;
  case 'SIZE3':
      if (( document.getElementById('ind1_ent3').value  * 1 ) > res && ( res != 0 ) ){
      alert("Own investment amount cannot be less than the minimum investment amount");

}
  myval = (( document.getElementById('ind1_entp3').value * 1 ) * ( res * 1 ) / 100 );
    if ( myval > ( document.getElementById('ind1_entx3').value  * 1 ) ){
myval = ( document.getElementById('ind1_entx3').value * 1 );

}
 break;
  case 'SIZE4':
   if (( document.getElementById('ind1_ent4').value  * 1 ) > res && ( res != 0 ) ){
   alert("Own investment amount cannot be less than the minimum investment amount");

}
  myval = (( document.getElementById('ind1_entp4').value * 1 ) * ( res * 1 ) / 100 );
   if ( myval > ( document.getElementById('ind1_entx4').value  * 1 ) ){
myval = ( document.getElementById('ind1_entx4').value * 1 );

}
  break;
}
sum = myval + ( (document.getElementById('est_dti_feh').value * 1 ) + (document.getElementById('est_dti_caph').value * 1 ) + (document.getElementById('est_dti_greh').value * 1 ) ) ;
gelih = document.getElementById('GV_ELIG_AVAIL_AMT1h').value * 1 ;
geli = document.getElementById('geam').value * 1 ;
var diff = ( geli - sum  ) ;


 document.getElementById('est_dti_ent').value = formats(myval);
 document.getElementById('est_dti_enth').value = myval;
 document.getElementById('invest_amt_ent').value = formats( res * 1 );
 document.getElementById('GV_ELIG_AVAIL_AMT1h').value = (geli - myval) ;
 document.getElementById('GV_ELIG_AVAIL_AMT1').value = formats(geli - sum);

}else{
str = document.getElementById('invest_amt_ent').value;
res = mask(str);
 switch(bb)
{
  case 'SIZE1':
 if (( document.getElementById('ma1_ent1').value  * 1 ) > res && ( res != 0 ) ){
 alert("Own investment amount cannot be less than the minimum investment amount");

}
 myval = (( document.getElementById('ma1_entp1').value * 1 ) * ( res * 1 ) / 100 );
  if ( myval > ( document.getElementById('ma1_entx1').value  * 1 ) ){
myval = ( document.getElementById('ma1_entx1').value * 1 );

}
  break;
  case 'SIZE2':
  if (( document.getElementById('ma1_ent2').value  * 1 ) > res && ( res != 0 ) ){
  alert("Own investment amount cannot be less than the minimum investment amount");

}
  myval = (( document.getElementById('ma1_entp2').value * 1 ) * ( res * 1 ) / 100 );
   if ( myval > ( document.getElementById('ma1_entx2').value  * 1 ) ){
myval = ( document.getElementById('ma1_entx2').value * 1 );

}
  break;
  case 'SIZE3':
  if (( document.getElementById('ma1_ent3').value  * 1 ) > res && ( res != 0 ) ){
  alert("Own investment amount cannot be less than the minimum investment amount");

}
  myval = (( document.getElementById('ma1_entp3').value * 1 ) * ( res * 1 ) / 100 );
  if ( myval > ( document.getElementById('ma1_entx3').value  * 1 ) ){
myval = ( document.getElementById('ma1_entx3').value * 1 );

}
 break;
  case 'SIZE4':
  if (( document.getElementById('ma1_ent4').value  * 1 ) > res && ( res != 0 ) ){
  alert("Own investment amount cannot be less than the minimum investment amount");

}
  myval = (( document.getElementById('ma1_entp4').value * 1 ) * ( res * 1 ) / 100 );
  if ( myval > ( document.getElementById('ma1_entx4').value  * 1 ) ){
myval = ( document.getElementById('ma1_entx4').value * 1 );

}
  break;
}
sum = myval + ( (document.getElementById('est_dti_feh').value * 1 ) + (document.getElementById('est_dti_caph').value * 1 ) + (document.getElementById('est_dti_greh').value * 1 ) ) ;
gelih = document.getElementById('GV_ELIG_AVAIL_AMT1h').value * 1 ;
geli = document.getElementById('geam').value * 1 ;
var diff = ( geli - sum  ) ;


 document.getElementById('est_dti_ent').value = formats(myval);
 document.getElementById('est_dti_enth').value = myval;
  document.getElementById('invest_amt_ent').value = formats( res * 1 );
   document.getElementById('GV_ELIG_AVAIL_AMT1h').value = (geli - myval) ;
 document.getElementById('GV_ELIG_AVAIL_AMT1').value = formats(geli - sum);

 }

}

if ( b == 3 ){
bus =  document.getElementById('involved_in').value;
if ( bus == 'ind1' ){
 str = document.getElementById('invest_amt_fe').value;
res = mask(str);
  switch(bb)
{
  case 'SIZE1':
if (( document.getElementById('ind1_fe1').value  * 1 ) > res && ( res != 0 ) ){
alert("Own investment amount cannot be less than the minimum investment amount");

}
 myval = (( document.getElementById('ind1_fep1').value * 1 ) * ( res * 1 ) / 100 );
 if ( myval > ( document.getElementById('ind1_fex1').value  * 1 ) ){
myval = ( document.getElementById('ind1_fex1').value * 1 );

}
  break;
  case 'SIZE2':
  if (( document.getElementById('ind1_fe2').value  * 1 ) > res && ( res != 0 ) ){
  alert("Own investment amount cannot be less than the minimum investment amount");

}
  myval = (( document.getElementById('ind1_fep2').value * 1 ) * ( res * 1 ) / 100 );
  if ( myval > ( document.getElementById('ind1_fex2').value  * 1 ) ){
myval = ( document.getElementById('ind1_fex2').value * 1 );

}
  break;
  case 'SIZE3':
   if (( document.getElementById('ind1_fe3').value  * 1 ) > res && ( res != 0 ) ){
   alert("Own investment amount cannot be less than the minimum investment amount");

}
  myval = (( document.getElementById('ind1_fep3').value * 1 ) * ( res * 1 ) / 100 );
  if ( myval > ( document.getElementById('ind1_fex3').value  * 1 ) ){
myval = ( document.getElementById('ind1_fex3').value * 1 );

}
 break;
  case 'SIZE4':
   if (( document.getElementById('ind1_fe4').value  * 1 ) > res && ( res != 0 ) ){
   alert("Own investment amount cannot be less than the minimum investment amount");

}
  myval = (( document.getElementById('ind1_fep4').value * 1 ) * ( res * 1 ) / 100 );
  if ( myval > ( document.getElementById('ind1_fex4').value  * 1 ) ){
myval = ( document.getElementById('ind1_fex4').value * 1 );

}
  break;
}
sum = myval + ( (document.getElementById('est_dti_enth').value * 1 ) + (document.getElementById('est_dti_caph').value * 1 ) + (document.getElementById('est_dti_greh').value * 1 ) ) ;
gelih = document.getElementById('GV_ELIG_AVAIL_AMT1h').value * 1 ;
geli = document.getElementById('geam').value * 1 ;
var diff = ( geli - sum  ) ;


 document.getElementById('est_dti_fe').value = formats(myval);
 document.getElementById('est_dti_feh').value = myval;
  document.getElementById('invest_amt_fe').value = formats( res * 1 );
 document.getElementById('GV_ELIG_AVAIL_AMT1h').value = (geli - myval) ;
 document.getElementById('GV_ELIG_AVAIL_AMT1').value = formats(geli - sum);


}else{
 str = document.getElementById('invest_amt_fe').value;
res = mask(str);
 switch(bb)
{
  case 'SIZE1':
 if (( document.getElementById('ma1_fe1').value  * 1 ) > res && ( res != 0 ) ){
 alert("Own investment amount cannot be less than the minimum investment amount");

}
 myval = (( document.getElementById('ma1_fep1').value * 1 ) * ( res * 1 ) / 100 );
 if ( myval > ( document.getElementById('ma1_fex1').value  * 1 ) ){
myval = ( document.getElementById('ma1_fex1').value * 1 );

}
  break;
  case 'SIZE2':
  if (( document.getElementById('ma1_fe2').value  * 1 ) > res && ( res != 0 ) ){
  alert("Own investment amount cannot be less than the minimum investment amount");

}
  myval = (( document.getElementById('ma1_fep2').value * 1 ) * ( res * 1 ) / 100 );
  if ( myval > ( document.getElementById('ma1_fex2').value  * 1 ) ){
myval = ( document.getElementById('ma1_fex2').value * 1 );

}
  break;
  case 'SIZE3':
  if (( document.getElementById('ma1_fe3').value  * 1 ) > res && ( res != 0 ) ){
  alert("Own investment amount cannot be less than the minimum investment amount");

}
  myval = (( document.getElementById('ma1_fep3').value * 1 ) * ( res * 1 ) / 100 );
  if ( myval > ( document.getElementById('ma1_fex3').value  * 1 ) ){
myval = ( document.getElementById('ma1_fex3').value * 1 );

}
 break;
  case 'SIZE4':
  if (( document.getElementById('ma1_fe4').value  * 1 ) > res && ( res != 0 ) ){
  alert("Own investment amount cannot be less than the minimum investment amount");

}
  myval = (( document.getElementById('ma1_fep4').value * 1 ) * ( res * 1 ) / 100 );
  if ( myval > ( document.getElementById('ma1_fex4').value  * 1 ) ){
myval = ( document.getElementById('ma1_fex4').value * 1 );

}
  break;
}


sum = myval + ( (document.getElementById('est_dti_enth').value * 1 ) + (document.getElementById('est_dti_caph').value * 1 ) + (document.getElementById('est_dti_greh').value * 1 ) ) ;
gelih = document.getElementById('GV_ELIG_AVAIL_AMT1h').value * 1 ;
geli = document.getElementById('geam').value * 1 ;
var diff = ( geli - sum  ) ;


 document.getElementById('est_dti_fe').value = formats(myval);
 document.getElementById('est_dti_feh').value = myval;
 document.getElementById('invest_amt_fe').value = formats( res * 1 );
 document.getElementById('GV_ELIG_AVAIL_AMT1h').value = (geli - myval) ;
 document.getElementById('GV_ELIG_AVAIL_AMT1').value = formats(geli - sum );

 }

}

}
</script>

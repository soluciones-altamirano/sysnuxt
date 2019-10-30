export default ({ app }, inject) => {


  inject('myInjectedFunction', string => console.log('That was easy!', string));


  inject('erroresToList', (errors) => {

    var res ="<ul style='list-style-type: none; padding:0px;'>";


    const entries = Object.entries(errors);

    for (const [field, fieldErrors] of entries) {

      fieldErrors.forEach(function (value) {
        res = res+'<li style="margin-bottom: .5rem">'+value+'</li>';

      })
    }

    res= res+'<ul/>';

    return res;
  })

  // inject('erroresToList', (errors) => {
  //
  //   var res ="<ul style='list-style-type: none; padding:0px;'>";
  //
  //   errors.keys().map(function (field,fieldErrors) {
  //
  //     fieldErrors.keys().map(function (index,error) {
  //       res = res+'<li>'+error+'</li>';
  //     })
  //   });
  //
  //   res= res+'<ul/>';
  //
  //   return res;
  // })
}

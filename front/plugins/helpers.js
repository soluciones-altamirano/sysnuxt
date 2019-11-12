

import Vue from 'vue'

Vue.mixin({
  methods:{

    consolaJs(/*...*/) {
      if (process.env.DEBUG || true) {
        for (var i = 0; i < arguments.length; i++) {
          console.log(arguments[i]);
        }
      }
    },
    errorToList(errors){
      var res ="<ul style='list-style-type: none; padding:0px;'>";


      const entries = Object.entries(errors);

      for (const [field, fieldErrors] of entries) {

        fieldErrors.forEach(function (value) {
          res = res+'<li style="margin-bottom: .5rem">'+value+'</li>';

        })
      }

      res= res+'<ul/>';

      return res;
    },

    notifySuccess(title,message){
      this.$notify.success({
        title: title,
        message: message
      })
    },
    notifyError(error){
      this.$notify.error({
        title: error,
        message: '',
        titleSize: 16
      })
    },
    notifyErrorList(errors){

      this.$notify.error({
        title: this.errorToList(errors),
        message: '',
        titleSize: 16
      })
    },
    pluckArrayObjets(array,value,key){

        const arrayObjects = array.map(function (item,val)  {

            const entradas = Object.entries(item);

            for (const [key, val] of entradas) {
                if (key==value){
                  return val
                }
            }

            return entradas[value];
        })


        return arrayObjects;
    },
    backUrl(){

      var back = this.$routerHistory.previous().path;


      this.consolaJs('regresar',back);

      this.$router.replace(back);

    }
  }
})


export default ({ app }, inject) => {


  inject('myInjectedFunction', string => console.log('That was easy!', string));

}

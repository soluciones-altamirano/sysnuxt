

import Vue from 'vue'

let globalDebug = (process.env.APP_DEBUG == 'true');

console.log('Debug:', globalDebug);

Vue.mixin({
  methods:{

    logInfo(/*...*/) {
      if (globalDebug) {
        var orig = console.log;

        orig.apply(console, arguments);

      }
    },
    logError(/*...*/) {
      if (globalDebug) {
        var orig = console.error;

        orig.apply(console, arguments);

      }
    },
    logWarn(/*...*/) {
      if (globalDebug) {
        var orig = console.warn;

        orig.apply(console, arguments);

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


      this.logInfo('regresar',back);

      this.$router.replace(back);

    },
    _can(permissionName) {

        return this.$auth.user.all_permissions.indexOf(permissionName) !== -1;

    }
  }
})

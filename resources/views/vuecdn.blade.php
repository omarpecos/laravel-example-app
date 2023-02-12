<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.7.14/vue.min.js" integrity="sha512-BAMfk70VjqBkBIyo9UTRLl3TBJ3M0c6uyy2VMUrq370bWs7kchLNN9j1WiJQus9JAJVqcriIUX859JOm12LWtw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <style>
    body{
      margin: 0;
    }
    h1, h2{
      text-align: center;
      padding: 10px;
    }
    .loader-container{
      min-width: 100vw;
      min-height: 100vh;
      background: black;
      position: relative;
    }

    .loader-container .loader{
      position: absolute;
      background: white;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 100px;
      height: 20px;
      animation: loader 1s ease-in-out 0s infinite;
    }
    /* Con rotateY en vez de el Z queda guapo también jaja */
    @keyframes loader {
      0% {
        transform: rotateZ(0deg) scale(1);
      }
      50% {
        transform: rotateZ(180deg) scale(0.5)
      }
      100% {
        transform: rotateZ(360deg) scale(1)
      }
    }

    .users-list{
      margin: 20px auto;
      width: 60%;
    }
    .users-list .user-row{
      padding: 5px;
      border: 1px solid plum;
    }
    .other-component{
      margin: 20px auto;
      width: 60%;
      border: 1px solid purple;
    }
    .other-component .form {
      width: 200px;
      margin: 10px auto;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }
    .other-component .form .input-container{
      position:  relative;
      width: 100%;
    }
    .other-component .form .input-container label{
      position: absolute;
      top: -1.2rem;
      bottom: 0;
      left:0;
      font-size: small;
    }
    .other-component .form .input-container input{
    position: relative;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
     border-radius: 10px;
     width: 100%;
     padding: 2px 5px;
    }
    .other-component .form .input-container input:focus{
    outline: none;
    }
    .other-component .form .input-container .input-error{
     border: 1px solid red;
    }
    .other-component .form .input-container .form-error{
      margin: 5px;
      margin-bottom: 0;
      font-size: smaller;
      color: red;
      display: block;
    }
    .other-component .submit {
      margin-top: 20px;
      background: orange;
    }
  </style>

</head>
<body>

  
<div id="vue-cdn">
  
  <div v-if="loading" class="loader-container">
    <div class="loader"></div>
  </div>
  <template v-else>
    <h1> This is @{{view}} </h1>
    
    <div class="users-list">
      <div v-for="user in users" class="user-row">
        @{{user.id}} - @{{user.email}} - @{{user.email}}
      </div>
    </div>

    <div class="other-component">
      <h2>Other component with validation</h2>
      <div class="form">
        <div class="input-container">
          <label for="name">Nombre</label>
          <input type="text" v-model="name" name="name" id="name" :class="{'input-error': name && errorName}" required pattern="[a-zA-Z\s]+">
          <span v-if="name && errorName" class="form-error">
            @{{errorName}}
          </span>
        </div>
        <button :disabled="!validForm" class="submit" @click="submit">Enviar</button>
      </div>
    </div>
  </template>
</div>
  
  <script>
  let app = new Vue({
      el:'#vue-cdn',
      data:{
          loading: true,
          view:'VUE with CDN',
          users: [],
          name: ''
      },
      async mounted(){
        console.log('This is a vue app loaded by CDN', this.view)
        await this.fetchData()
      },
      computed:{
        errorName(){
          // https://www.w3schools.com/js/js_validation_api.asp
          // se puede sacar por cada tipo que saque el mensaje que tu quieras por cada tipo de error patternMismatch pues no cumple el formato, valueMissing: campo requerido etc...
          if (!this.name) return 'valueMissing'
          // se puede hacer con una ref que es algo mas limpio que esto
          const name = document.querySelector('#name');
          if (name && !name.checkValidity()) {
            return name.validationMessage || 'Campo no válido'
          }
          else return ''
        },
        validForm(){
          if (this.name && !this.errorName) return true
          else return false
        }
      },
      methods: {
        async fetchData(){
        try {
          this.loading = true
          // wait fake 300ms 
          await new Promise((resolve) => setTimeout(resolve, 300))
          const res = await fetch('http://localhost:8000/api/users/all')
          const json = await res.json();
          this.users = json
          this.loading = false
          
        } catch (error) {
          this.loading = false
          console.log('error', error)
        }
      },
      async submit(){
        try{
          // wait fake 1s 
           await new Promise((resolve) => setTimeout(resolve, 1000))
           const body = JSON.stringify({name: this.name})
           const res = await fetch('http://localhost:8000/api/form', {method: 'POST', body})
           const json = await res.json();
           if (!json.status) {
             alert('Error: ' + JSON.stringify(json.error))
           } else  alert('Todo ok')
        } catch(error) {
          console.log('error', error)
          // mejor a futuro con un sweetalert o algo de eso
          alert('Error: ' + error.message)
        }
      }
      }
  });
  </script>
</body>
</html>
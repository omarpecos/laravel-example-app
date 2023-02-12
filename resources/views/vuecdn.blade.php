<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.7.14/dist/vue.js"></script> 

  @vite('resources/css/vue-cdn.css')
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
        @{{user.id}} - @{{user.email}} - @{{user.name}}
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
  
 @vite('resources/js/vue-cdn.js')
</body>
</html>
<template>
    <div>
        <div v-for="(value, name) in handshakes">
              <div v-if="value.length>2"><pre>{{ value }}</pre></div>
        </div>
    </div>

</template>

<script>
export default{
    name:"Handshakes",
    props: ['handshakes']
  
}
</script>
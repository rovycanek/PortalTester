<template>
    <div>
        <h4>Present</h4>
        <div v-for="(value, name) in present">
            <div><li class="list-group-item" style="padding-top: 0.05rem;padding-bottom: 0.05rem;">{{name}}: {{value}}</li></div>
        </div>
    </div>

</template>

<script>
export default{
    name:"missingSH",
    props: ['present']
  
}
</script>













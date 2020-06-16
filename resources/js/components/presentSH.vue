<template>
    <div>
        <h4>Present</h4>
        <div v-for="(value in present">
            <div v-if="value.length>2">
                <div><li class="list-group-item" style="padding-top: 0.05rem;padding-bottom: 0.05rem;">{{value}}</li></div>
            </div>
        </div>
    </div>

</template>

<script>
export default{
    name:"missingSH",
    props: ['present']
  
}
</script>













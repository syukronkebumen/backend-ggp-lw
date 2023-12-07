<div 
    x-data = "{show : false}"
    x-show = "show"
    x-on:open-modal.window = "console.log($event.detail); show = true"
    x-on:close-modal.window = "show = false"
    x-on:keydown.escape.window = "show = false"
    >
    <div>Header</div>
    <div>Body</div>
</div>
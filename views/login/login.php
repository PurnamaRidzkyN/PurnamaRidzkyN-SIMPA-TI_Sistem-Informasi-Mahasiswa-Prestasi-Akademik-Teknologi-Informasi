<section class="bg-primary-500 w-full h-screen grid place-content-center">
    <div class="bg-white rounded-[30px] px-14 py-10 flex flex-col items-center justify-center">

        <div>
            <div class="text-center mb-5">
                <h1 class="font-[Raleway] font-bold h1 text-center text-primary-700">SIMPA-TI</h1>
                <div class="mt-3 flex flex-col">
                    <h1 class="h3 font-medium">Silahkan Masuk</h1>
                    <h1 class="h5 text-neutral-500 font-normal">Masukan username dan kata sandi anda</h1>
                </div>
            </div>


            <form action="/post-login" method="post" class="flex flex-col gap-3">
                <!-- username -->
                <div>
                    <label for="username" class="flex flex-col gap-3">
                        <h5 class="h6 text-neutral-500">username</h5>
                        <input type="text" name="username" id="username"
                            class="px-5 py-2 h6 text-neutral-500 bg-neutral-100 border border-neutral-200 rounded-md">
                    </label>
                </div>
                <!-- password -->
                <div>
                    <label for="password" class="flex flex-col gap-3">
                        <h5 class="h6 text-neutral-500">Password</h5>
                        <input type="password" name="password" id="password"
                            class="px-5 py-2 h6 text-neutral-500 bg-neutral-100 border border-neutral-200 rounded-md">
                    </label>
                </div>
                <?php echo app\cores\View::getData()["error"] ?? "" ?>
                <!-- view checkbox -->
                <div>
                    <label for="viewPassword" class="flex gap-1 items-center">
                        <input type="checkbox" name="viewPassword" id="viewPassword" class="size-4">
                        <p class="p1 text-neutral-500">Tampilkan Kata Sandi</p>
                    </label>
                </div>

                <button class="h5 bg-primary-600 text-white rounded-[15px] px-5 py-3 mt-5" type="submit">Masuk</button>
            </form>
        </div>


    </div>
</section>



<script>
$(() => {
    $("#viewPassword").on("change", function() {
        const passwordField = $("#password");
        const isChecked = $(this).is(":checked");

        // Toggle the type attribute of the password field
        passwordField.attr("type", isChecked ? "text" : "password");
    });
});
</script>
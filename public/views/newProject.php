<?php require_once __DIR__."/shared/_configuration.php"; ?>

<!doctype html>
<html lang=<?php echo $_SESSION['lang'] ?>>

<?php require_once __DIR__.'/shared/_headTag.php'; ?>

<body>
    <?php require __DIR__ . '/shared/_header.php'; ?>

    <main class="main-container">
        <h1 class="page-header">Create new project</h1>

        <form class="new-project-form">
            <div class="messages">
                <?php
                    if (isset($messages))
                    {
                        foreach ($messages as $message)
                        {
                            echo $message;
                        }                         
                    }
                ?>
            </div>
            <input class="input-field-line-under main-input" name="title" type="text" autocomplete="off" placeholder="Title...">
            <textarea class="input-field-line-under main-input description-input" name="description" rows="1"
                type="text" placeholder="Description..."></textarea>

            <section class="git-form">
                <h1>Connect with:</h1>
                <div class="input-radio-container connect-with-container">
                    <input type="radio" id="gitTool1" name="gitTool" value="github" checked>
                    <label for="gitTool1"><i class="fab fa-github"></i></label>
                    <input type="radio" id="gitTool2" name="gitTool" value="bitbucket" unchecked>
                    <label for="gitTool2"><i class="fab fa-bitbucket"></i></label>
                    <input type="radio" id="gitTool3" name="gitTool" value="gitlab" unchecked>
                    <label for="gitTool3"><i class="fab fa-gitlab"></i></label>
                </div>
                <hr>

                <h1>Visibility:</h1>
                <div class="input-radio-container visibility-container">
                    <input type="radio" id="visibility-visible" name="visibility" value="public" checked>
                    <label for="visibility-visible">
                        <i class="fas fa-eye"></i>
                        <div>Public</div>
                    </label>
                    <input type="radio" id="visibility-hidden" name="visibility" value="private" unchecked>
                    <label for="visibility-hidden">
                        <i class="fas fa-lock"></i>
                        <div>Private</div>
                    </label>
                </div>
                <hr>
            </section>

            <div class="upload-img-container">
                <div class="input-field-round button bt-green add-background-img-bt">
                    <label>
                        <div>
                            <input id="input-img-upload" type="file" name="file">
                            <i class="fas fa-upload"></i>
                            Upload background image
                        </div>
                        <label>
                </div>

                <p id="upload-img-path">No file chosen</p>
            </div>

            <div class="technologies">
                <input type="text" class="input-field-line-under technologies-input"
                    placeholder="Technologies..." autocomplete="off">
                <div class="choose-technology">
                </div>
            </div>
            <div class="selected-technologies">

            </div>

            <button type="submit" class="input-field-round button bt-blue submit-bt">Create project</button>
        </form>
    </main>
</body>

<template id="technology-template">
    <div class="technology-button"><p>technology</p><i class="fas fa-plus-circle"></i></div>
</template>

</html>
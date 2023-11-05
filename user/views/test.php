<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        .list {
            width: 200px;
            height: 200px;
            background-color: red;
            display: flex;
            overflow-x: hidden;
        }
        .img > img {
            width: 100%;
        }
        .content {
            flex-shrink: 0;
            height: 100px;
            width: 200px;
            background-color: gray;
            display: flex;
            justify-content: space-between;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const contents = document.querySelectorAll(".content");
            let currentIndex = 0;
            const totalContents = contents.length;
            const positionDisplay = document.querySelector(".position-display");

            function showContent(index) {
                contents.forEach((content, i) => {
                    if (i === index) {
                        content.style.display = "flex";
                    } else {
                        content.style.display = "none";
                    }
                });
            }

            function updatePosition() {
                positionDisplay.textContent = (currentIndex + 1) + "/" + totalContents;
            }

            const buttonTang = document.querySelector("button[name='tang']");
            buttonTang.addEventListener("click", function() {
                currentIndex = (currentIndex + 1) % totalContents;
                showContent(currentIndex);
                updatePosition();
            });

            const buttonGiam = document.querySelector("button[name='giam']");
            buttonGiam.addEventListener("click", function() {
                currentIndex = (currentIndex - 1 + totalContents) % totalContents;
                showContent(currentIndex);
                updatePosition();
            });

            // Hiển thị phần tử đầu tiên ban đầu
            showContent(currentIndex);
            updatePosition();
        });
    </script>

    <div class="comment">
        <div class="list">
            <?php for ($i = 0; $i < 11; $i++) : ?>
                <div class="content" style="display: <?= $i === 0 ? 'flex' : 'none'; ?>">
                    <p>áafasfdsafa</p>
                    <img src="../../assets/img/Rectangle 33.png" width="25px" alt="">
                </div>
            <?php endfor ?>
        </div>
        <div class="button">
            <button name="tang">tăng</button>
            <div class="position-display"><?= $totalContents ?> / <?= $totalContents ?></div>
            <input type="number">
            <button name="giam">giam</button>
        </div>
    </div>
</body>
</html>

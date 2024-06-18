<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="navbar">
    <a href="../../../../LeGuideDuBaroudeur/Application/View/index/index.php" class="logo">Le Guide du Baroudeur</a>
    <div class="menu">
        <a href="../leprojet.php">Le projet</a>
        <a href="../contact.php">Contact</a>
        <a href="../apropos.php">A propos</a>
    </div>
    <div class="right">
        <div class="dropdown">
            <button id="articlesButton" class="dropbtn">
                Articles
            </button>
            <div id="articlesDropdownMenu" class="dropdown-content">
                <?php foreach ($articles2 as $article2): ?>
                    <a href="../articles/articles.php?id=<?php echo $article2['articleid'] ?>"><?php echo $article2['schoolname'] ?></a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php if (!isset($_SESSION['user'])): ?>
            <a href="../../../../LeGuideDuBaroudeur/Application/Controller/connectionController.php" class="login">Se
                connecter</a>
        <?php else: ?>
            <div class="dropdown">
                <button id="profileButton" class="dropbtn2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" viewBox="0 0 24 24">
                        <path fill="#32c665"
                              d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4"/>
                    </svg>
                </button>
                <div id="dropdownMenu" class="dropdown-content">
                    <a href="../index/index.php?logout=1" id="logout">Déconnexion</a>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const profileButton = document.getElementById('profileButton');
        const dropdownMenu = document.getElementById('dropdownMenu');
        const articlesButton = document.getElementById('articlesButton');
        const articlesDropdownMenu = document.getElementById('articlesDropdownMenu');

        if (profileButton) {
            profileButton.addEventListener('click', () => {
                closeDropdown(articlesDropdownMenu); // Ferme le dropdown des articles si ouvert
                toggleDropdown(dropdownMenu);
            });
        }

        if (articlesButton) {
            articlesButton.addEventListener('click', () => {
                closeDropdown(dropdownMenu); // Ferme le dropdown du profil si ouvert
                toggleDropdown(articlesDropdownMenu);
            });
        }

        window.addEventListener('click', (event) => {
            if (!event.target.closest('.dropdown')) {
                closeDropdown(dropdownMenu);
                closeDropdown(articlesDropdownMenu);
            }
        });

        function toggleDropdown(element) {
            if (element) {
                element.style.display = element.style.display === 'block' ? 'none' : 'block';
            }
        }

        function closeDropdown(element) {
            if (element) {
                element.style.display = 'none';
            }
        }
    });
</script>
</body>
</html>
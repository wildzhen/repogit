<?php

// Change WooCommerce "Related products" Text

        add_filter('gettext', 'change_rp_text', 10, 3);
        add_filter('ngettext', 'change_rp_text', 10, 3);

        function change_rp_text($translated, $text, $domain)
        {
            if ($text === 'Related products' && $domain === 'woocommerce') {
                $translated = esc_html__('Recommandations', $domain);
            }
            $translated= str_replace("Filtrer les termes", "Rechercher", $translated);
            $translated= str_replace("Afficher uniquement les produits en vente", "Voir les soldes", $translated);
            $translated= str_replace("Next", "Suivant", $translated);
            $translated= str_replace("Previous", "Precédent", $translated);
            return $translated;
        }

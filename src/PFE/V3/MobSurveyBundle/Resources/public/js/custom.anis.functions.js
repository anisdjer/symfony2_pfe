/**
 * Created with JetBrains PhpStorm.
 * User: Anis
 * Date: 09/05/13
 * Time: 00:26
 * To change this template use File | Settings | File Templates.
 */

function deleteUser(url , sender_)
{
    new Anis('Voulez-vous vraiment supprimer', {
            title: 'Supprimer',
            buttons: [	{id: 0, label: 'Oui', val: 'Y'},
                {id: 1, label: 'Non', val: 'N'}
            ],
            callback: function(val) {
                switch (val){
                    case 'Y' :
                        $.ajax({
                                type: "POST",
                                url: url,
                                data: { _method : "DELETE"}
                            }
                        )
                            .done(function(msg){
                                var vsender = $(sender_).parent().parent().parent().parent().parent().parent();
                                vsender.next().remove();
                                vsender.remove();
                            })
                            .fail(function() { alert('erreur'); })
                        ;

                        break;
                    case 'N' :break;
                }
            }
        }
    );
}

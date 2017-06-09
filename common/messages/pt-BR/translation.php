<?php

return [
    
    /** MENU * */
    'menu.home' => 'Início',
    'menu.language' => 'Língua',
    'menu.login' => 'Autenticação',
    'menu.administration' => 'Administração',
    'menu.user_register' => 'Cadastro de Usuário',
    'menu.access_control' => 'Controle de Acesso',
    'menu.change_password' => 'Mudar Senha',
    'menu.general_config_label' => 'Configurações Gerais',
    'menu.operative_menu_label' => 'Operacional',    
    'menu.institution' => 'Instituição',
    'menu.jurisdiction' => 'Jurisdição',
    'menu.workgroup' => 'Grupo de Trabalho',
    'menu.config_variables' => 'Variáveis de Sistema',
    'menu.logout' => 'Sair',
    
    /** LANGUAGES **/
    'menu.language.english' => 'Inglês',
    'menu.language.portuguese' => 'Português',
    
    /** GENERAL **/
    'Admin' => 'Listagem',
    'Update'=>'Atualizar',
    'Create'=>'Salvar',
    'Delete' => 'Apagar',
    'Cancel' => 'Cancelar',
    'update_title'=>'Atualizar: {name}',
    'Are you sure you want to delete this item?' => 'Tem certeza que deseja excluir este item?',
    'Search' => 'Procurar',
    'Notice' => 'Aviso',
    'Info' => 'Informativo',
    'Preview' => 'Visualizar',
    
    /** SITE CONTROLLER * */
    'site.set_language.message_language_selected_title' => 'Mudança de Idioma',
    'site.set_language.message_language_selected' => 'Idioma selecionado ({language})',
    'site.login.title' => 'Autenticação',
    'site.login.form_login.email' => 'Login ou Email',
    'site.login.form_login.password' => 'Senha',
    'site.login.form_login.btn_login' => 'Acessar',
    'site.login.form_login.reset_password_label' => 'Esqueceu sua senha?',
    'site.login.form_reset_password.new_password_saved' => 'Nova senha salva com sucesso!',
    'site.login.form_reset_password.title' => 'Criar nova senha',
    'site.login.form_reset_password.instructions' => 'Por favor, preencha seu email. O link de criar nova senha senha será enviado por email.',
    'site.login.form_reset_password.send' => 'Enviar',
    'site.login.form_reset_password.check_message_further' => 'Verifique seu email. As instruções para criar nova senha foram enviadas com sucesso.',
    'site.login.form_reset_password.error_email_message_fail' => 'Desculpe, não conseguimos enviar o email. Tente mais tarde.',
    'site.login.form_reset_password.email_not_detected' => 'O endereço de email não foi identificado',
    'site.login.form_reset_password.email_subject' => 'Solicitação de criação de senha para {user_name}',
    'site.reset_password.email_html' => '<p>Oi {username},</p><p>Clique no link abaixo para criar uma nova senha:</p><p>{link}</p>',
    
    // CONFIG MODEL/CONTROLLER
    'config' => 'Variável',
    'configs' => 'Variáveis de Sistema',
    'config.id' => 'Id',
    'config.varname' => 'Nome da Variável',
    'config.value' => 'Valor da Variável',
    
    // USER MODEL/CONTROLLER
    'user'=>'Usuário',
    'users'=>'Usuários',
    'user.name' => 'Nome Completo',
    'user.username' => 'Login',
    'user.email' => 'Email',
    'user.password' => 'Senha',
    'user.status' => 'Status',
    'user.status_active' => 'Ativo',
    'user.status_inactive' => 'Inativo',
    'user.create_at' => 'Criado em',
    'user.list_title' => 'Administrar Usuários',
    'user.btn_create' => 'Novo Usuário',
    'user.btn_update' => 'Alterar Usuário',
    'user.btn_manage' => 'Administrar Usuários',
    'user.update.title' => 'Alterar Usuário',
    'user.signup.title' => 'Novo Usuário',
    'user.signup.instructions' => 'Preencha os sequintes campos para registrar:',
    'user.signup.bt_signup' => 'Salvar',
    'user.signup_form.message_username_unique' => 'Este username já foi definido',
    'user.signup_form.message_email_unique' => 'Este email já foi definido',
    'user.signup_form.name' => 'Nome Completo',
    'user.signup_form.username' => 'Login',
    'user.signup_form.email' => 'Email',
    'user.signup_form.password' => 'Senha',
    'user.message_unique_field' => 'O campo {field} já está sendo usado',
    
    // INSTITUTION MODEL/CONTROLLER
    'institution' => 'Instituição',
    'institutions' => 'Instituições',
    'institution.id' => 'id',
    'institution.email' => 'Email',
    'institution.phone' => 'Telefone',
    'institution.name' => 'Nome',
    'institution.country' => 'País',
    'institution.abbreviation' => 'Sigla',
    'institution.cap_configuration_title' => 'Configurações do CAP',
    'institution.abbreviation_cap' => 'Sigla CAP',
    'institution.sender_cap' => 'Sender CAP',
    'institution.contact_cap' => 'Contact CAP',
    'institution.language_cap' => 'Language CAP',
    'institution.created_at'=> 'Data Criação',
    'institution.updated_at'=> 'Data Atualização',
    'institution.create_title'=> 'Nova Instituição',
    'institution.create_btn'=> 'Nova Instituição',
    'institution.message_delete_institution_with_jurisdiction' => 'Não foi possível apagar a Instituição {name} pois existem jurisdições associadas',
    
    
    // JURISDICTION MODEL/CONTROLLER
    'jurisdiction'=>'Jurisdição',
    'jurisdictions' => 'Jurisdições',
    'jurisdiction.id' => 'Id',
    'jurisdiction.name' => 'Nome',
    'jurisdiction.institution_id' => 'Instituição',
    'jurisdiction.color' => 'Cor',
    'jurisdiction.geom' => 'Geometria', 
    'jurisdiction.geom_hint' => 'WKT - Polygon ou Multipolygon [Projeção 3857 - Google]',
    'jurisdiction.created_at'=> 'Data Criação',
    'jurisdiction.updated_at'=> 'Data Atualização',
    'jurisdiction.created_by'=> 'Criado por',
    'jurisdiction.updated_by'=> 'Atualizado por',
    'jurisdiction.create_title'=> 'Nova Jurisdição',
    'jurisdiction.create_btn'=> 'Nova Jurisdição',
    'jurisdiction.opacity' => 'Opacidade',
    'jurisdiction.modal_locals_btn' => 'Importar Locais',
    'jurisdiction.modal_locals_title' => 'Importar Locais',
    
    // WORKGROUP MODEL/CONTROLLER
    'workgroup' => 'Grupo de Trabalho',
    'workgroups' => 'Grupos de Trabalho',
    'workgroup.id' => 'Id',
    'workgroup.name' => 'Nome',
    'workgroup.description' => 'Descrição',
    'workgroup.created_at'=> 'Data Criação',
    'workgroup.updated_at'=> 'Data Atualização',
    'workgroup.created_by'=> 'Criado por',
    'workgroup.updated_by'=> 'Atualizado por',
    'workgroup.create_title'=> 'Novo Grupo de Trabalho',
    'workgroup.create_btn'=> 'Novo Grupo de Trabalho',
    'workgroup.associate_jurisdiction_title'=>'Associar Jurisdições',
    'workgroup.associate_jurisdiction_btn' => 'Associar Jurisdição',
    'workgroup.associate_user_title'=>'Associar Usuários',
    'workgroup.associate_user_btn' => 'Associar Usuário',
    'workgroup.available' => 'Não Contidos',
    'workgroup.selected' => 'Contidos',
    'workgroup.associate_jurisdiction_dualbox_title'=>'Jurisdições Associadas',
    'workgroup.associate_users_dualbox_title' => 'Usuários Associados'
    
];

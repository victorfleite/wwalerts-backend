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
    'menu.institution' => 'Instituição',
    'menu.jurisdiction' => 'Jurisdição',
    'menu.workgroup' => 'Grupo de Trabalho',
    'menu.logout' => 'Sair',
    
    /** LANGUAGES **/
    'menu.language.english' => 'Inglês',
    'menu.language.portuguese' => 'Português',
    
    /** GENERAL **/
    'Update'=>'Atualizar',
    'Create'=>'Salvar',
    
    /** SITE CONTROLLER * */
    'site.set_language.message_language_selected' => 'Idioma selecionado ({language})',
    'site.login.title' => 'Autenticação',
    'site.login.form_login.email' => 'Login ou Email',
    'site.login.form_login.password' => 'Senha',
    'site.login.form_login.btn_login' => 'Acessar',
    'site.login.form_login.reset_password_label' => 'Esqueceu sua senha?',
    'site.login.form_reset_password.title' => 'Criar nova senha',
    'site.login.form_reset_password.instructions' => 'Por favor, preencha seu email. O link de criar nova senha senha será enviado por email.',
    'site.login.form_reset_password.send' => 'Enviar',
    'site.login.form_reset_password.check_message_further' => 'Verifique seu email. As instruções para criar nova senha foram enviadas com sucesso.',
    'site.login.form_reset_password.error_email_message_fail' => 'Desculpe, não conseguimos enviar o email. Tente mais tarde.',
    'site.login.form_reset_password.email_not_detected' => 'O endereço de email não foi identificado',
    'site.login.form_reset_password.email_subject' => 'Solicitação de criação de senha para {user_name}',
    'site.reset_password.email_html' => '<p>Oi {username},</p><p>Clique no link abaixo para criar uma nova senha:</p><p>{link}</p>',
           
    /** USER MODEL/CONTROLLER * */
    'user'=>'Usuário',
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
    
    // Institution
    'institution' => 'Instituição',
    'institutions' => 'Instituições',
    'institution.id' => 'id',
    'institution.email' => 'Email',
    'institution.phone' => 'Telefone',
    'institution.name' => 'Nome',
    'institution.country' => 'País',
    'institution.abbreviation' => 'Sigla',
    'institution.abbreviation_cap' => 'Sigla CAP',
    'institution.sender_cap' => 'Sender CAP',
    'institution.contact_cap' => 'Contact CAP',
    'institution.language_cap' => 'Language CAP',
    'institution.create_title'=> 'Nova Instituição',
    'institution.create_btn'=> 'Nova Instituição',
];

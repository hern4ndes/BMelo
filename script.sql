insert into institucional
(nome,titulo,texto_sobre,texto_encontre_nos,
    telefones,email, created, status)
values(
'nome','titulo','sobre...','encontre-nos...','(99) 99999-9999','empresa@empresa.com',
now(),1);


insert into usuario (nome,email,senha,admin,acessos,
	created,status)
values ('master','master@bmelofilho.com.br','eb029bbe164cd116dd9efc2cb21959b7',
	true,0,now(),true);

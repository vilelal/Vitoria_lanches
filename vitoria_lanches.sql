create database BD_vitoria_lanches;
use BD_vitoria_lanches;
 
create table tb_usuarios
(
	TB_USUARIOS_ID INTEGER PRIMARY KEY AUTO_INCREMENT,
	TB_USUARIOS_USERNAME VARCHAR(32) NOT NULL UNIQUE,
    TB_USUARIOS_PASSWORD VARCHAR(16) NOT NULL,
    TB_USUARIOS_TIPO VARCHAR(20) NOT NULL
);
 
create table tb_cliente
(
	TB_CLIENTE_ID INTEGER PRIMARY KEY AUTO_INCREMENT,
    TB_CLIENTE_NOME VARCHAR(128) NOT NULL,
    TB_CLIENTE_TEL VARCHAR(32) NOT NULL,
    TB_CLIENTE_ENDERECO VARCHAR(128),
    TB_CLIENTE_ENDERECO_NUM VARCHAR(8),
    TB_USUARIO_FK INTEGER NOT NULL,
    FOREIGN KEY(TB_USUARIO_FK) REFERENCES tb_usuarios(TB_USUARIOS_ID)
);
 
 
create table tb_pedido_venda
(
	TB_PEDIDO_VENDA_ID INTEGER PRIMARY KEY AUTO_INCREMENT,
    TB_CLIENTE_ID INTEGER NOT NULL,
    TB_PEDIDO_VENDA_DATA DATETIME NOT NULL,
    TB_PEDIDO_VENDA_VAL_TOTAL DECIMAL(10,2) NOT NULL,
    TB_PEDIDO_VENDA_STATUS VARCHAR(16) NOT NULL,
    TB_PEDIDO_VENDA_FORMA_PAG VARCHAR(32) NOT NULL,
    TB_PEDIDO_VENDA_OBS VARCHAR(500),
    FOREIGN KEY(TB_CLIENTE_ID) REFERENCES tb_cliente(TB_CLIENTE_ID)
);
 
create table tb_tipo_produto
(
	TB_TIPO_PRODUTO_ID INTEGER PRIMARY KEY AUTO_INCREMENT,
    TB_TIPO_PRODUTO_DESC VARCHAR(32) NOT NULL
);
 
create table tb_produto
(
	TB_PRODUTO_ID INTEGER PRIMARY KEY AUTO_INCREMENT,
    TB_PRODUTO_NOME VARCHAR(128) NOT NULL,
    TB_TIPO_PRODUTO_ID INTEGER NOT NULL,
    TB_PRODUTO_DESC VARCHAR(512),
    TB_PRODUTO_PRECO_UNIT DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (TB_TIPO_PRODUTO_ID) REFERENCES tb_tipo_produto(TB_TIPO_PRODUTO_ID)
);
 
create table tb_pedido
(
	TB_PEDIDO_ID INTEGER PRIMARY KEY AUTO_INCREMENT,
    TB_PRODUTO_ID INTEGER NOT NULL,
    TB_PEDIDO_VENDA_ID INTEGER NOT NULL,
    TB_PEDIDO_PRODUTO_QTD INTEGER NOT NULL,
    TB_PEDIDO_PRODUTO_PRECO_UNIT DECIMAL(10,2) NOT NULL,
    TB_PEDIDO_PRODUTO_PRECO_TOTAL DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (TB_PRODUTO_ID) REFERENCES tb_produto(TB_PRODUTO_ID), 
    FOREIGN KEY (TB_PEDIDO_VENDA_ID) REFERENCES tb_pedido_venda(TB_PEDIDO_VENDA_ID) 
);
 
 
 
 
alter table tb_pedido_venda
modify column TB_PEDIDO_VENDA_VAL_TOTAL DECIMAL(10,2);
 
insert into tb_usuarios
(
	TB_USUARIOS_USERNAME,
    TB_USUARIOS_PASSWORD,
    TB_USUARIOS_TIPO
) VALUES 
	('root','123','cliente'),
    ('r1','1234','cliente'),
    ('r2','12345','cliente'),
    ('r3','1321','cliente'),
    ('r4','5123','cliente'),
    ('r5','6124','cliente'),
    ('r6','61243','cliente'),
    ('r7','612523','cliente'),
    ('r8','52346','cliente'),
    ('r9','3257','cliente'),
    ('r10','32467','cliente'),
    ('r11','1312','cliente');
    
 
INSERT INTO tb_cliente
(
tb_cliente.TB_CLIENTE_NOME,
tb_cliente.TB_CLIENTE_TEL,
tb_cliente.TB_CLIENTE_ENDERECO,
tb_cliente.TB_CLIENTE_ENDERECO_NUM,
tb_cliente.TB_USUARIO_FK
) VALUES('MARIA APARECIDA','(11) 93456-7890','RUA DAS FLORES','102',1),
('JOÃO CARLOS','(11) 94567-1234','AVENIDA PAULISTA','1500',2),
('ANA LUIZA','(11) 95234-9988','TRAVESSA DO SOL','15',3),
('PEDRO HENRIQUE','(11) 98765-4321','RUA SANTO ANTÔNIO','245',4),
('FERNANDA OLIVEIRA','(11) 99123-4567','ALAMEDA DAS PALMEIRAS','78',5),
('CARLOS EDUARDO','11) 98888-7777','RUA DAS PEDRAS','316',6),
('BEATRIZ MARTINS','(11) 97345-1111','AVENIDA CENTRAL','500',7),
('LUCIANO FREITAS','(11) 96000-6543','RUA DOS CRAVOS','93',8),
('CAMILA ROCHA','(11) 97890-3210','TRAVESSA VERMELHA','22',9),
('RENATO GOMES','(11) 99555-8888','AVENIDA DOS IPÊS','1234',10),
('LARISSA FERREIRA','(11) 95678-9000','RUA DO MERCADO','49',11),
('THIAGO SILVA','(11) 96222-3333','RUA DAS JASMINS','876',12);

INSERT INTO tb_produto (
TB_PRODUTO_NOME,
TB_TIPO_PRODUTO_ID,
TB_PRODUTO_DESC,
TB_PRODUTO_PRECO_UNIT)
VALUES
('X-SALADA',1,'carne, queijo, cebola, tomate, alface, pão e picles',27.00),
('X-BACON',1,'carne, queijo, bacon crocante, alface, tomate e pão com gergelim',29.00),
('HOT DOG',1,'salsicha, purê de batata, ketchup, mostarda, milho, batata palha e pão',18.00),
('MISTO QUENTE',1,'pão de forma com presunto e queijo, tostado na chapa ',12.00),
('COXINHA',2,'massa de batata recheada com frango desfiado e empanada', 8.00),
('KIBE',2,'trigo, carne moída temperada e hortelã, frito até dourar', 7.00),
('ESFIHA',2,'massa assada recheada com carne temperada',9.00),
('EMPADA',2,'massa amanteigada recheada com frango cremoso',8.50),
('SUCO DE LARANJA',3,'suco natural de laranja, sem adição de açúcar',10.00),
('ÁGUA MINERAL',3,'água mineral sem gás, 500ml',5.00),
('REFRIGERANTE COLA',3,'refrigerante sabor cola, lata 350ml',6.00),
('CHÁ GELADO',3,'chá preto gelado com limão, 500ml',7.00),
(' BATATA FRITA',4,'batatas crocantes servidas com molho especial',22.00),
('FRANGO À PASSARINHO',4,'pedaços de frango temperados e fritos com alho',28.00),
('CALABRESA ACEBOLADA',4,'linguiça calabresa fatiada com cebola caramelizada',25.00),
('MANDIOCA FRITA',4,'mandioca crocante por fora e macia por dentro',20.00),
('SORVETE DE CHOCOLATE',5,'sorvete cremoso sabor chocolate',10.00),
('SORVETE DE MORANGO',5,'sorvete sabor morango com pedaços da fruta',10.00),
('SORVETE DE COCO',5,'sorvete sabor coco com lascas naturais',10.00),
('SORVETE NAPOLITANO',5,'combinação de chocolate, morango e creme',12.00),
('PUDIM DE LEITE',6,'pudim cremoso com calda de caramelo',14.00),
('TORTA DE LIMÃO',6,'base crocante com recheio de limão e cobertura de merengue',15.00),
('MOUSSE DE MARACUJÁ',6,'mousse leve e aerado com calda de maracujá',13.00),
('ROCAMBOLE',6,'massa de pão de ló recheada com chocolate ou doce de leite',16.00),
('BRIGADEIRO',7,'doce de chocolate enrolado e coberto com granulado',3.00),
('BEIJINHO',7,'doce de coco com leite condensado e açúcar cristal',3.00),
('PAÇOCA',7,'doce de amendoim prensado',2.50),
('BALA DE COCO',7,'bala macia de coco com cobertura açucarada',2.00),
('PIZZA DE CALABRESA',8,'molho de tomate, queijo muçarela, calabresa e cebola',45.00),
('PIZZA DE MUÇARELA',8,'molho de tomate e queijo muçarela gratinado',42.00),
('PIZZA PORTUGUESA',8,'presunto, ovos, cebola, pimentão, azeitona e queijo',48.00),
('PIZZA DE FRANGO COM CATUPIRY',8,'frango desfiado com catupiry e muçarela',50.00),
('PASTEL DE CARNE',9,'massa crocante recheada com carne moída temperada',9.00),
('PASTEL DE QUEIJO',9,'recheio de queijo muçarela derretido',9.00),
('PASTEL DE PIZZA',9,'recheio de queijo, tomate e orégano',10.00),
('PASTEL DE PALMITO',9,'recheio cremoso de palmito com temperos suaves',10.00);


select * from tb_usuarios;
select * from tb_cliente;
 
drop database BD_vitoria_lanches;
 
 

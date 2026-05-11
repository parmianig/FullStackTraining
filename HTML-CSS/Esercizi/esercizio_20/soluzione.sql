-- es 1 e 2
Create table spesa {
    id int auto_increment primary key,
    nome varchar(255) not null,
    categoria varchar(255) not null,
    quantita int not null default 1,
    prezzo decimal(10, 2) not null
}

-- es 3
-- Nome, Categoria, Quantità, Prezzo
insert into spesa (nome, categoria, quantita, prezzo) values
('Mele', 'Alimentari', 5, 2.50),
('Latte', 'Alimentari', 2, 1.50),
('Pane', 'Alimentari', 1, 2.00),
('Uova', 'Alimentari', 12, 3.00),
('Mele', 'Alimentari', 6, 0.50),
('Carne', 'Alimentari', 1, 10.00)
('Bulloni', 'Ferramenta', 10, 3.00)
('Viti', 'Ferramenta', 4, 4.50)

-- MOSTRA TUTTO dalla tabella prodotti.
select * from spesa;

-- MOSTRA TUTTO dalla tabella prodotti DOVE la categoria è uguale a "Alimentari".
select * from spesa where catgoria = 'Alimentari';

-- MOSTRA TUTTO dalla tabella prodotti DOVE la categoria è uguale a "Alimentari" E il prezzo è maggiore di 2.00.
select * from spesa where categoria = 'Alimentari' and prezzo > 2.

-- es 4
-- MODIFICA prodotti AGGIUNGI scadenza (tipo data) DOPO la colonna nome.
alter table spesa add scadenza date after nome;

-- MODIFICA prodotti AGGIUNGI nota (tipo testo) CON VALORE PREDEFINITO "Nessuna nota".
alter table spesa add nota varchar(255) after scadenza default 'Nessuna nota';
const { MongoClient } = require('mongodb');

async function main() {
    const uri = 'mongodb://localhost:27017';
    const client = new MongoClient(uri, { useNewUrlParser: true, useUnifiedTopology: true });

    try {
        await client.connect();
        console.log('Conectado a MongoDB');

        const database = client.db('prueba_jaal_alcaldia');
        const collection = database.collection('productos');

        // Inserta documentos en la colección productos
        const productos = [
            { id: 1, nombre: 'Producto 1', precio: 100, cantidad: 10 },
            { id: 2, nombre: 'Producto 2', precio: 200, cantidad: 20 },
            { id: 3, nombre: 'Producto 3', precio: 300, cantidad: 30 }
        ];

        const insertResult = await collection.insertMany(productos);
        console.log('Documentos insertados:', insertResult.insertedCount);
    } catch (err) {
        console.error('Error al conectar a MongoDB', err);
    } finally {
        await client.close();
    }
}

main().catch(console.error);
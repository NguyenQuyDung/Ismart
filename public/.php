$table->string('masp');
            $table->string('thumbnail');
            $table->string('name');
            $table->unsignedBigInteger('price');
            $table->bigInteger('qty');
            $table->unsignedBigInteger('subtotal');
            $table->string('payment');
            $table->string('status',50);
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');//Thiết lập khóa ngoại cho bảng xóa du lieu ca 2 bang
            $table->string('MaKH',50);
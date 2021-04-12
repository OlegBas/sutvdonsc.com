/*

 ������ � jQuery ��� �������� ��������������� ����

 �����: �������� ������ ����������

 */



(

	function ($)
	{



		$.fn.rowsInput = function (value)

		{



			var rowsInputElement = this;



			generate(value);





			if(numRow() <= 1)

			{

				minusHide();

			}


			$(rowsInputElement).find("input[value='+']").unbind('click');
			$(rowsInputElement).find("input[value='+']").on("click",

				function ()

				{

					minusShow();

					addRow($(this).parent().parent(),false);
				}

			);


			$(rowsInputElement).find("input[value='-']").unbind('click');
			$(rowsInputElement).find("input[value='-']").on("click",

				function ()

				{

					if(numRow() > 1)

					{

						$($(this).parent().parent()).remove();

					}

					if(numRow() == 1)

					{

						minusHide();

					}

					posGen();



				}

			);



			function numRow()

			{

				//alert(thisClass);



				return $(rowsInputElement).find("tr").size();



			}



			function minusHide()

			{

				$(rowsInputElement).find("input[value='-']").css("display","none");

			}



			function minusShow()

			{

				$(rowsInputElement).find("input[value='-']").css("display","");

			}



			function addRow(el, value)

			{

				var newRow = el.clone(true).insertAfter(el);




				if(!value)

				{

					newRow.find(":input").not(":button").not("[type=checkbox]").val("");

					newRow.find(":checkbox")[0].checked  =false;





				}

				else

				{

					var s=0;

					newRow.find(":input").not(":button").each

					(

						function ()

						{
							if($(this).attr('type') == 'checkbox')
							{

								$(this)[0].checked = false;
								if(value[0][s] === "1") $(this)[0].checked = true;
							}
							else
							{
								$(this).val(value[0][s]);
							}

							s++;

						}

					);

				}

				//alert($(rowsInputElement).html());



				posGen();
				checkbox_name();



			}



			function generate(value)

			{



				if(value==undefined)

				{

					var row = 0;

				}

				else

				{

					var row = value.length;

					if(row > 0)
					{
						$(rowsInputElement).find("input[value='+']").unbind('click');
						$(rowsInputElement).find("tr").not(':first').remove();
					}
				}







				if(row > 0)

				{

					var s=0;

					$(rowsInputElement).find("tr:first").find(":input").not(":button").each
					(
						function ()
						{
							if($(this).attr('type') == 'checkbox')
							{
								$(this)[0].checked = false;
								if(value[0][s] === "1") $(this)[0].checked = true;
							}
							else
							{
								var val = value[0][s];
								val = val.replace(/&quot;/g, "\u0022");
								val = val.replace(/&#039;/g, "\u0027");
								$(this).val(val);
							}
							s++;

						}

					);

					for(i=1;i<row;i++)

					{





						var newRow = $(rowsInputElement).find("tr:first").clone(true).appendTo(rowsInputElement);

						var s=0;

						newRow.find(":input").not(":button").each

						(

							function ()

							{



								if($(this).attr('type') == 'checkbox')
								{

									$(this)[0].checked = false;
									if(value[i][s] === "1") $(this)[0].checked = true;
								}
								else
								{
									var val = value[i][s];
									val = val.replace(/&quot;/g, "\u0022");
									val = val.replace(/&#039;/g, "\u0027");
									$(this).val(val);
								}

								s++;

							}

						);



					}

				}

				posGen();

				checkbox_name();

			}



			function posGen()

			{


				pos = 1;

				$("input[name='pos[]']").each

				(

					function ()
					{

						$(this).val(pos);

						pos++;

					}

				);
			}


			function checkbox_name()
			{
				row = 0;
				return $(rowsInputElement).find("tr").each(
					function()
					{
						$(this).find("[type=checkbox]").each(
							function ()
							{
								name = $(this).attr("name");

								$(this).attr("name", name.replace(/\[\d?\]$/,"["+row+"]"));


							}
						);

						row++;
					}
				);
			}


		}

	}

)(jQuery);


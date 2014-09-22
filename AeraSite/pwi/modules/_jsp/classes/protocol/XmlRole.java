/*     */ package protocol;
/*     */ 
/*     */ import com.goldhuman.Common.Octets;
/*     */ import com.goldhuman.IO.Protocol.Rpc.Data.DataVector;
/*     */ import java.io.ByteArrayInputStream;
/*     */ import java.io.ByteArrayOutputStream;
/*     */ import java.io.File;
/*     */ import java.io.FileInputStream;
/*     */ import java.io.FileNotFoundException;
/*     */ import java.io.FileOutputStream;
/*     */ import java.io.InputStream;
/*     */ import java.io.UnsupportedEncodingException;
/*     */ import javax.xml.parsers.DocumentBuilder;
/*     */ import javax.xml.parsers.DocumentBuilderFactory;
/*     */ import javax.xml.parsers.ParserConfigurationException;
/*     */ import javax.xml.transform.Transformer;
/*     */ import javax.xml.transform.TransformerConfigurationException;
/*     */ import javax.xml.transform.TransformerException;
/*     */ import javax.xml.transform.TransformerFactory;
/*     */ import javax.xml.transform.dom.DOMResult;
/*     */ import javax.xml.transform.dom.DOMSource;
/*     */ import javax.xml.transform.stream.StreamResult;
/*     */ import javax.xml.transform.stream.StreamSource;
/*     */ import org.apache.commons.lang.StringEscapeUtils;
/*     */ import org.w3c.dom.Document;
/*     */ import org.w3c.dom.Element;
/*     */ import org.w3c.dom.Node;
/*     */ import org.w3c.dom.NodeList;
/*     */ 
/*     */ public class XmlRole extends XmlRoleBase
/*     */ {
/*     */   public static byte[] toXMLByteArray(Role role)
/*     */     throws ParserConfigurationException, Exception, TransformerConfigurationException
/*     */   {
/*  26 */     Document doc = toXML(role);
/*  27 */     ByteArrayOutputStream baos = new ByteArrayOutputStream();
/*  28 */     Transformer trans = TransformerFactory.newInstance().newTransformer();
/*  29 */     trans.transform(new DOMSource(doc), new StreamResult(baos));
/*  30 */     return baos.toByteArray();
/*     */   }
/*     */ 
/*     */   public static Role fromXML(InputStream inputStream) throws XmlRoleBase.XmlRoleException, UnsupportedEncodingException, ParserConfigurationException, TransformerConfigurationException, TransformerException
/*     */   {
/*  35 */     Document doc = DocumentBuilderFactory.newInstance().newDocumentBuilder().newDocument();
/*  36 */     Transformer trans = TransformerFactory.newInstance().newTransformer();
/*  37 */     trans.transform(new StreamSource(inputStream), new DOMResult(doc));
/*  38 */     return fromXML(doc);
/*     */   }
/*     */ 
/*     */   public static Role fromXML(byte[] byteArray) throws XmlRoleBase.XmlRoleException, UnsupportedEncodingException, ParserConfigurationException, TransformerConfigurationException, TransformerException
/*     */   {
/*  43 */     return fromXML(new ByteArrayInputStream(byteArray));
/*     */   }
/*     */ 
/*     */   public static Role fromXML(File file) throws XmlRoleBase.XmlRoleException, UnsupportedEncodingException, ParserConfigurationException, TransformerConfigurationException, TransformerException, FileNotFoundException
/*     */   {
/*  48 */     return fromXML(new FileInputStream(file));
/*     */   }
/*     */ 
/*     */   public static void toXMLFile(Role role, File file) throws ParserConfigurationException, Exception, TransformerConfigurationException
/*     */   {
/*  53 */     Document doc = toXML(role);
/*  54 */     Transformer trans = TransformerFactory.newInstance().newTransformer();
/*  55 */     trans.transform(new DOMSource(doc), new StreamResult(new FileOutputStream(file)));
/*     */   }
/*     */ 
/*     */   public static Role fromXML(Document doc) throws XmlRoleBase.XmlRoleException, UnsupportedEncodingException
/*     */   {
/*  60 */     Role role = new Role();
/*  61 */     Element root = doc.getDocumentElement();
/*  62 */     NodeList list = root.getChildNodes();
/*  63 */     for (int i = 0; i < list.getLength(); i++)
/*     */     {
/*  65 */       Node node = list.item(i);
/*  66 */       String name = node.getNodeName();
/*  67 */       if (!name.equals("#text"))
/*     */       {
/*  69 */         if (name.equals("base"))
/*  70 */           role.base = getGRoleBase((Element)node, "base");
/*  71 */         else if (name.equals("equipment"))
/*  72 */           role.equipment = getGRoleEquipment((Element)node, "equipment");
/*  73 */         else if (name.equals("pocket"))
/*  74 */           role.pocket = getGRolePocket((Element)node, "pocket");
/*  75 */         else if (name.equals("status"))
/*  76 */           role.status = getGRoleStatus((Element)node, "status");
/*  77 */         else if (name.equals("storehouse"))
/*  78 */           role.storehouse = getGRoleStorehouse((Element)node, "storehouse");
/*  79 */         else if (name.equals("task"))
/*  80 */           role.task = getGRoleTask((Element)node, "task");
/*     */         else
/*  82 */           throw new XmlRoleBase.XmlRoleException("fromXML(Document). list.size=" + Integer.toString(list.getLength()) + ", node name=" + name); 
/*     */       }
/*     */     }
/*  84 */     return 0 == list.getLength() ? null : role;
/*     */   }
/*     */ 
/*     */   private static GRoleBase getGRoleBase(Element currentelement, String parentName)
/*     */     throws XmlRoleBase.XmlRoleException, UnsupportedEncodingException
/*     */   {
/*  98 */     NodeList currentnodelist = currentelement.getElementsByTagName("variable");
/*  99 */     GRoleBase grolebase = new GRoleBase();
/*     */ 
/* 101 */     String name = unescapeUnprintable(StringEscapeUtils.unescapeXml(getElementValue(currentnodelist, "name", parentName)));
/* 102 */     grolebase.name = new Octets(name.getBytes("UTF-16LE"));
/* 103 */     grolebase.cls = Integer.parseInt(getElementValue(currentnodelist, "cls", parentName));
/* 104 */     grolebase.config_data = new Octets(hextoByteArray(getElementValue(currentnodelist, "config_data", parentName)));
/* 105 */     grolebase.create_time = Integer.parseInt(getElementValue(currentnodelist, "create_time", parentName));
/* 106 */     grolebase.custom_data = new Octets(hextoByteArray(getElementValue(currentnodelist, "custom_data", parentName)));
/* 107 */     grolebase.custom_stamp = Integer.parseInt(getElementValue(currentnodelist, "custom_stamp", parentName));
/* 108 */     grolebase.delete_time = Integer.parseInt(getElementValue(currentnodelist, "delete_time", parentName));
/* 109 */     NodeList subnodelist6 = currentelement.getElementsByTagName("forbid");
/* 110 */     grolebase.forbid = getGRoleForbidVector(subnodelist6, "forbid");
/* 111 */     grolebase.gender = Byte.parseByte(getElementValue(currentnodelist, "gender", parentName));
/* 112 */     grolebase.help_states = new Octets(hextoByteArray(getElementValue(currentnodelist, "help_states", parentName)));
/* 113 */     grolebase.id = Integer.parseInt(getElementValue(currentnodelist, "id", parentName));
/* 114 */     grolebase.lastlogin_time = Integer.parseInt(getElementValue(currentnodelist, "lastlogin_time", parentName));
/* 115 */     grolebase.race = Integer.parseInt(getElementValue(currentnodelist, "race", parentName));
/* 116 */     grolebase.reserved1 = Integer.parseInt(getElementValue(currentnodelist, "reserved1", parentName));
/* 117 */     grolebase.spouse = Integer.parseInt(getElementValue(currentnodelist, "spouse", parentName));
/* 118 */     grolebase.status = Byte.parseByte(getElementValue(currentnodelist, "status", parentName));
/* 119 */     grolebase.userid = Integer.parseInt(getElementValue(currentnodelist, "userid", parentName));
/* 120 */     grolebase.version = Byte.parseByte(getElementValue(currentnodelist, "version", parentName));
/* 121 */     return grolebase;
/*     */   }
/*     */ 
/*     */   private static GRoleEquipment getGRoleEquipment(Element currentelement, String parentName) throws XmlRoleBase.XmlRoleException, UnsupportedEncodingException
/*     */   {
/* 126 */     NodeList currentnodelist = currentelement.getElementsByTagName("variable");
/* 127 */     GRoleEquipment groleequipment = new GRoleEquipment();
/* 128 */     NodeList subnodelist0 = currentelement.getElementsByTagName("inv");
/* 129 */     groleequipment.inv = getGRoleInventoryVector(subnodelist0, "inv");
/* 130 */     return groleequipment;
/*     */   }
/*     */ 
/*     */   private static GRoleForbid getGRoleForbid(Element currentelement, String parentName) throws XmlRoleBase.XmlRoleException, UnsupportedEncodingException
/*     */   {
/* 135 */     NodeList currentnodelist = currentelement.getElementsByTagName("variable");
/* 136 */     GRoleForbid groleforbid = new GRoleForbid();
/* 137 */     groleforbid.createtime = Integer.parseInt(getElementValue(currentnodelist, "createtime", parentName));
/* 138 */     groleforbid.reason = new Octets(hextoByteArray(getElementValue(currentnodelist, "reason", parentName)));
/* 139 */     groleforbid.time = Integer.parseInt(getElementValue(currentnodelist, "time", parentName));
/* 140 */     groleforbid.type = Byte.parseByte(getElementValue(currentnodelist, "type", parentName));
/* 141 */     return groleforbid;
/*     */   }
/*     */ 
/*     */   private static GRoleInventory getGRoleInventory(Element currentelement, String parentName) throws XmlRoleBase.XmlRoleException, UnsupportedEncodingException
/*     */   {
/* 146 */     NodeList currentnodelist = currentelement.getElementsByTagName("variable");
/* 147 */     GRoleInventory groleinventory = new GRoleInventory();
/* 148 */     groleinventory.count = Integer.parseInt(getElementValue(currentnodelist, "count", parentName));
/* 149 */     groleinventory.data = new Octets(hextoByteArray(getElementValue(currentnodelist, "data", parentName)));
/* 150 */     groleinventory.expire_date = Integer.parseInt(getElementValue(currentnodelist, "expire_date", parentName));
/* 151 */     groleinventory.guid1 = Integer.parseInt(getElementValue(currentnodelist, "guid1", parentName));
/* 152 */     groleinventory.guid2 = Integer.parseInt(getElementValue(currentnodelist, "guid2", parentName));
/* 153 */     groleinventory.id = Integer.parseInt(getElementValue(currentnodelist, "id", parentName));
/* 154 */     groleinventory.mask = Integer.parseInt(getElementValue(currentnodelist, "mask", parentName));
/* 155 */     groleinventory.max_count = Integer.parseInt(getElementValue(currentnodelist, "max_count", parentName));
/* 156 */     groleinventory.pos = Integer.parseInt(getElementValue(currentnodelist, "pos", parentName));
/* 157 */     groleinventory.proctype = Integer.parseInt(getElementValue(currentnodelist, "proctype", parentName));
/* 158 */     return groleinventory;
/*     */   }
/*     */ 
/*     */   private static GRolePocket getGRolePocket(Element currentelement, String parentName) throws XmlRoleBase.XmlRoleException, UnsupportedEncodingException
/*     */   {
/* 163 */     NodeList currentnodelist = currentelement.getElementsByTagName("variable");
/* 164 */     GRolePocket grolepocket = new GRolePocket();
/* 165 */     grolepocket.capacity = Integer.parseInt(getElementValue(currentnodelist, "capacity", parentName));
/* 166 */     NodeList subnodelist1 = currentelement.getElementsByTagName("items");
/* 167 */     grolepocket.items = getGRoleInventoryVector(subnodelist1, "items");
/* 168 */     grolepocket.money = Integer.parseInt(getElementValue(currentnodelist, "money", parentName));
/* 169 */     grolepocket.reserved1 = Integer.parseInt(getElementValue(currentnodelist, "reserved1", parentName));
/* 170 */     grolepocket.reserved2 = Integer.parseInt(getElementValue(currentnodelist, "reserved2", parentName));
/* 171 */     grolepocket.timestamp = Integer.parseInt(getElementValue(currentnodelist, "timestamp", parentName));
/* 172 */     return grolepocket;
/*     */   }
/*     */ 
/*     */   private static GRoleStatus getGRoleStatus(Element currentelement, String parentName) throws XmlRoleBase.XmlRoleException, UnsupportedEncodingException
/*     */   {
/* 177 */     NodeList currentnodelist = currentelement.getElementsByTagName("variable");
/* 178 */     GRoleStatus grolestatus = new GRoleStatus();
/* 179 */     grolestatus.charactermode = new Octets(hextoByteArray(getElementValue(currentnodelist, "charactermode", parentName)));
/* 180 */     grolestatus.coolingtime = new Octets(hextoByteArray(getElementValue(currentnodelist, "coolingtime", parentName)));
/* 181 */     grolestatus.custom_status = new Octets(hextoByteArray(getElementValue(currentnodelist, "custom_status", parentName)));
/* 182 */     grolestatus.dbltime_begin = Integer.parseInt(getElementValue(currentnodelist, "dbltime_begin", parentName));
/* 183 */     grolestatus.dbltime_data = new Octets(hextoByteArray(getElementValue(currentnodelist, "dbltime_data", parentName)));
/* 184 */     grolestatus.dbltime_expire = Integer.parseInt(getElementValue(currentnodelist, "dbltime_expire", parentName));
/* 185 */     grolestatus.dbltime_max = Integer.parseInt(getElementValue(currentnodelist, "dbltime_max", parentName));
/* 186 */     grolestatus.dbltime_mode = Integer.parseInt(getElementValue(currentnodelist, "dbltime_mode", parentName));
/* 187 */     grolestatus.dbltime_used = Integer.parseInt(getElementValue(currentnodelist, "dbltime_used", parentName));
/* 188 */     grolestatus.exp = Integer.parseInt(getElementValue(currentnodelist, "exp", parentName));
/* 189 */     grolestatus.faction_contrib = new Octets(hextoByteArray(getElementValue(currentnodelist, "faction_contrib", parentName)));
/* 190 */     grolestatus.filter_data = new Octets(hextoByteArray(getElementValue(currentnodelist, "filter_data", parentName)));
/* 191 */     grolestatus.force_data = new Octets(hextoByteArray(getElementValue(currentnodelist, "force_data", parentName)));
/* 192 */     grolestatus.hp = Integer.parseInt(getElementValue(currentnodelist, "hp", parentName));
/* 193 */     grolestatus.instancekeylist = new Octets(hextoByteArray(getElementValue(currentnodelist, "instancekeylist", parentName)));
/* 194 */     grolestatus.invader_state = Integer.parseInt(getElementValue(currentnodelist, "invader_state", parentName));
/* 195 */     grolestatus.invader_time = Integer.parseInt(getElementValue(currentnodelist, "invader_time", parentName));
/* 196 */     grolestatus.level = Integer.parseInt(getElementValue(currentnodelist, "level", parentName));
/* 197 */     grolestatus.level2 = Integer.parseInt(getElementValue(currentnodelist, "level2", parentName));
/* 198 */     grolestatus.mp = Integer.parseInt(getElementValue(currentnodelist, "mp", parentName));
/* 199 */     grolestatus.multi_exp_ctrl = new Octets(hextoByteArray(getElementValue(currentnodelist, "multi_exp_ctrl", parentName)));
/* 200 */     grolestatus.npc_relation = new Octets(hextoByteArray(getElementValue(currentnodelist, "npc_relation", parentName)));
/* 201 */     grolestatus.pariah_time = Integer.parseInt(getElementValue(currentnodelist, "pariah_time", parentName));
/* 202 */     grolestatus.petcorral = new Octets(hextoByteArray(getElementValue(currentnodelist, "petcorral", parentName)));
/* 203 */     grolestatus.posx = Float.parseFloat(getElementValue(currentnodelist, "posx", parentName));
/* 204 */     grolestatus.posy = Float.parseFloat(getElementValue(currentnodelist, "posy", parentName));
/* 205 */     grolestatus.posz = Float.parseFloat(getElementValue(currentnodelist, "posz", parentName));
/* 206 */     grolestatus.pp = Integer.parseInt(getElementValue(currentnodelist, "pp", parentName));
/* 207 */     grolestatus.property = new Octets(hextoByteArray(getElementValue(currentnodelist, "property", parentName)));
/* 208 */     grolestatus.reputation = Integer.parseInt(getElementValue(currentnodelist, "reputation", parentName));
/* 209 */     grolestatus.reserved31 = Byte.parseByte(getElementValue(currentnodelist, "reserved31", parentName));
/* 210 */     grolestatus.reserved32 = Short.parseShort(getElementValue(currentnodelist, "reserved32", parentName));
/* 211 */     grolestatus.reserved4 = Integer.parseInt(getElementValue(currentnodelist, "reserved4", parentName));
/* 212 */     grolestatus.reserved5 = Integer.parseInt(getElementValue(currentnodelist, "reserved5", parentName));
/* 213 */     grolestatus.skills = new Octets(hextoByteArray(getElementValue(currentnodelist, "skills", parentName)));
/* 214 */     grolestatus.sp = Integer.parseInt(getElementValue(currentnodelist, "sp", parentName));
/* 215 */     grolestatus.storage_task = new Octets(hextoByteArray(getElementValue(currentnodelist, "storage_task", parentName)));
/* 216 */     grolestatus.storehousepasswd = new Octets(hextoByteArray(getElementValue(currentnodelist, "storehousepasswd", parentName)));
/* 217 */     grolestatus.storesize = Short.parseShort(getElementValue(currentnodelist, "storesize", parentName));
/* 218 */     grolestatus.time_used = Integer.parseInt(getElementValue(currentnodelist, "time_used", parentName));
/* 219 */     grolestatus.var_data = new Octets(hextoByteArray(getElementValue(currentnodelist, "var_data", parentName)));
/* 220 */     grolestatus.version = Byte.parseByte(getElementValue(currentnodelist, "version", parentName));
/* 221 */     grolestatus.waypointlist = new Octets(hextoByteArray(getElementValue(currentnodelist, "waypointlist", parentName)));
/* 222 */     grolestatus.worldtag = Integer.parseInt(getElementValue(currentnodelist, "worldtag", parentName));
/* 223 */     return grolestatus;
/*     */   }
/*     */ 
/*     */   private static GRoleStorehouse getGRoleStorehouse(Element currentelement, String parentName) throws XmlRoleBase.XmlRoleException, UnsupportedEncodingException
/*     */   {
/* 228 */     NodeList currentnodelist = currentelement.getElementsByTagName("variable");
/* 229 */     GRoleStorehouse grolestorehouse = new GRoleStorehouse();
/* 230 */     grolestorehouse.capacity = Integer.parseInt(getElementValue(currentnodelist, "capacity", parentName));
/* 231 */     NodeList subnodelist1 = currentelement.getElementsByTagName("dress");
/* 232 */     grolestorehouse.dress = getGRoleInventoryVector(subnodelist1, "dress");
/* 233 */     NodeList subnodelist2 = currentelement.getElementsByTagName("items");
/* 234 */     grolestorehouse.items = getGRoleInventoryVector(subnodelist2, "items");
/* 235 */     NodeList subnodelist3 = currentelement.getElementsByTagName("material");
/* 236 */     grolestorehouse.material = getGRoleInventoryVector(subnodelist3, "material");
/* 237 */     grolestorehouse.money = Integer.parseInt(getElementValue(currentnodelist, "money", parentName));
/* 238 */     grolestorehouse.reserved = Integer.parseInt(getElementValue(currentnodelist, "reserved", parentName));
/* 239 */     grolestorehouse.size1 = Byte.parseByte(getElementValue(currentnodelist, "size1", parentName));
/* 240 */     grolestorehouse.size2 = Byte.parseByte(getElementValue(currentnodelist, "size2", parentName));
/* 241 */     return grolestorehouse;
/*     */   }
/*     */ 
/*     */   private static GRoleTask getGRoleTask(Element currentelement, String parentName) throws XmlRoleBase.XmlRoleException, UnsupportedEncodingException
/*     */   {
/* 246 */     NodeList currentnodelist = currentelement.getElementsByTagName("variable");
/* 247 */     GRoleTask groletask = new GRoleTask();
/* 248 */     groletask.task_complete = new Octets(hextoByteArray(getElementValue(currentnodelist, "task_complete", parentName)));
/* 249 */     groletask.task_data = new Octets(hextoByteArray(getElementValue(currentnodelist, "task_data", parentName)));
/* 250 */     groletask.task_finishtime = new Octets(hextoByteArray(getElementValue(currentnodelist, "task_finishtime", parentName)));
/* 251 */     NodeList subnodelist3 = currentelement.getElementsByTagName("task_inventory");
/* 252 */     groletask.task_inventory = getGRoleInventoryVector(subnodelist3, "task_inventory");
/* 253 */     return groletask;
/*     */   }
/*     */ 
/*     */   private static Rpc.Data.DataVector getGRoleForbidVector(NodeList currentnodelist, String parentName) throws XmlRoleBase.XmlRoleException, UnsupportedEncodingException
/*     */   {
/* 258 */     Rpc.Data.DataVector groleforbid = new Rpc.Data.DataVector(new GRoleForbid());
/* 259 */     for (int i = 0; i < currentnodelist.getLength(); i++)
/*     */     {
/* 261 */       Element subnode = (Element)currentnodelist.item(i);
/* 262 */       GRoleForbid tmp = getGRoleForbid(subnode, parentName);
/* 263 */       groleforbid.add(tmp);
/*     */     }
/* 265 */     return groleforbid;
/*     */   }
/*     */ 
/*     */   private static Rpc.Data.DataVector getGRoleInventoryVector(NodeList currentnodelist, String parentName) throws XmlRoleBase.XmlRoleException, UnsupportedEncodingException
/*     */   {
/* 270 */     Rpc.Data.DataVector groleinventory = new Rpc.Data.DataVector(new GRoleInventory());
/* 271 */     for (int i = 0; i < currentnodelist.getLength(); i++)
/*     */     {
/* 273 */       Element subnode = (Element)currentnodelist.item(i);
/* 274 */       GRoleInventory tmp = getGRoleInventory(subnode, parentName);
/* 275 */       groleinventory.add(tmp);
/*     */     }
/* 277 */     return groleinventory;
/*     */   }
/*     */ 
/*     */   private static Node createGRoleBase(Document doc, GRoleBase grolebase, String nodename)
/*     */     throws Exception
/*     */   {
/* 288 */     Element node = doc.createElement(nodename);
/* 289 */     node.appendChild(doc.createTextNode("\n"));
/* 290 */     node.appendChild(createVariable(doc, "cls", "int", Integer.toString(grolebase.cls)));
/* 291 */     node.appendChild(doc.createTextNode("\n"));
/* 292 */     node.appendChild(createVariable(doc, "config_data", "Octets", grolebase.config_data));
/* 293 */     node.appendChild(doc.createTextNode("\n"));
/* 294 */     node.appendChild(createVariable(doc, "create_time", "int", Integer.toString(grolebase.create_time)));
/* 295 */     node.appendChild(doc.createTextNode("\n"));
/* 296 */     node.appendChild(createVariable(doc, "custom_data", "Octets", grolebase.custom_data));
/* 297 */     node.appendChild(doc.createTextNode("\n"));
/* 298 */     node.appendChild(createVariable(doc, "custom_stamp", "int", Integer.toString(grolebase.custom_stamp)));
/* 299 */     node.appendChild(doc.createTextNode("\n"));
/* 300 */     node.appendChild(createVariable(doc, "delete_time", "int", Integer.toString(grolebase.delete_time)));
/* 301 */     node.appendChild(doc.createTextNode("\n"));
/* 302 */     for (int i = 0; i < grolebase.forbid.size(); i++)
/*     */     {
/* 304 */       GRoleForbid groleforbid = (GRoleForbid)grolebase.forbid.get(i);
/* 305 */       node.appendChild(createGRoleForbid(doc, groleforbid, "forbid"));
/*     */     }
/* 307 */     node.appendChild(createVariable(doc, "gender", "byte", Byte.toString(grolebase.gender)));
/* 308 */     node.appendChild(doc.createTextNode("\n"));
/* 309 */     node.appendChild(createVariable(doc, "help_states", "Octets", grolebase.help_states));
/* 310 */     node.appendChild(doc.createTextNode("\n"));
/* 311 */     node.appendChild(createVariable(doc, "id", "int", Integer.toString(grolebase.id)));
/* 312 */     node.appendChild(doc.createTextNode("\n"));
/* 313 */     node.appendChild(createVariable(doc, "lastlogin_time", "int", Integer.toString(grolebase.lastlogin_time)));
/* 314 */     node.appendChild(doc.createTextNode("\n"));
/*     */ 
/* 316 */     String tmp = StringEscapeUtils.escapeXml(new String(grolebase.name.getBytes(), "UTF-16LE"));
/* 317 */     String names = escapeUnprintable(tmp);
/* 318 */     node.appendChild(createVariable(doc, "name", "Octets", names));
/* 319 */     node.appendChild(doc.createTextNode("\n"));
/* 320 */     node.appendChild(createVariable(doc, "race", "int", Integer.toString(grolebase.race)));
/* 321 */     node.appendChild(doc.createTextNode("\n"));
/* 322 */     node.appendChild(createVariable(doc, "reserved1", "int", Integer.toString(grolebase.reserved1)));
/* 323 */     node.appendChild(doc.createTextNode("\n"));
/* 324 */     node.appendChild(createVariable(doc, "spouse", "int", Integer.toString(grolebase.spouse)));
/* 325 */     node.appendChild(doc.createTextNode("\n"));
/* 326 */     node.appendChild(createVariable(doc, "status", "byte", Byte.toString(grolebase.status)));
/* 327 */     node.appendChild(doc.createTextNode("\n"));
/* 328 */     node.appendChild(createVariable(doc, "userid", "int", Integer.toString(grolebase.userid)));
/* 329 */     node.appendChild(doc.createTextNode("\n"));
/* 330 */     node.appendChild(createVariable(doc, "version", "byte", Byte.toString(grolebase.version)));
/* 331 */     node.appendChild(doc.createTextNode("\n"));
/* 332 */     return node;
/*     */   }
/*     */ 
/*     */   private static Node createGRoleEquipment(Document doc, GRoleEquipment groleequipment, String nodename) throws Exception {
/* 336 */     Element node = doc.createElement(nodename);
/* 337 */     node.appendChild(doc.createTextNode("\n"));
/* 338 */     for (int i = 0; i < groleequipment.inv.size(); i++)
/*     */     {
/* 340 */       GRoleInventory groleinventory = (GRoleInventory)groleequipment.inv.get(i);
/* 341 */       node.appendChild(createGRoleInventory(doc, groleinventory, "inv"));
/*     */     }
/* 343 */     return node;
/*     */   }
/*     */ 
/*     */   private static Node createGRoleForbid(Document doc, GRoleForbid groleforbid, String nodename) throws Exception {
/* 347 */     Element node = doc.createElement(nodename);
/* 348 */     node.appendChild(doc.createTextNode("\n"));
/* 349 */     node.appendChild(createVariable(doc, "createtime", "int", Integer.toString(groleforbid.createtime)));
/* 350 */     node.appendChild(doc.createTextNode("\n"));
/* 351 */     node.appendChild(createVariable(doc, "reason", "Octets", groleforbid.reason));
/* 352 */     node.appendChild(doc.createTextNode("\n"));
/* 353 */     node.appendChild(createVariable(doc, "time", "int", Integer.toString(groleforbid.time)));
/* 354 */     node.appendChild(doc.createTextNode("\n"));
/* 355 */     node.appendChild(createVariable(doc, "type", "byte", Byte.toString(groleforbid.type)));
/* 356 */     node.appendChild(doc.createTextNode("\n"));
/* 357 */     return node;
/*     */   }
/*     */ 
/*     */   private static Node createGRoleInventory(Document doc, GRoleInventory groleinventory, String nodename) throws Exception {
/* 361 */     Element node = doc.createElement(nodename);
/* 362 */     node.appendChild(doc.createTextNode("\n"));
/* 363 */     node.appendChild(createVariable(doc, "count", "int", Integer.toString(groleinventory.count)));
/* 364 */     node.appendChild(doc.createTextNode("\n"));
/* 365 */     node.appendChild(createVariable(doc, "data", "Octets", groleinventory.data));
/* 366 */     node.appendChild(doc.createTextNode("\n"));
/* 367 */     node.appendChild(createVariable(doc, "expire_date", "int", Integer.toString(groleinventory.expire_date)));
/* 368 */     node.appendChild(doc.createTextNode("\n"));
/* 369 */     node.appendChild(createVariable(doc, "guid1", "int", Integer.toString(groleinventory.guid1)));
/* 370 */     node.appendChild(doc.createTextNode("\n"));
/* 371 */     node.appendChild(createVariable(doc, "guid2", "int", Integer.toString(groleinventory.guid2)));
/* 372 */     node.appendChild(doc.createTextNode("\n"));
/* 373 */     node.appendChild(createVariable(doc, "id", "int", Integer.toString(groleinventory.id)));
/* 374 */     node.appendChild(doc.createTextNode("\n"));
/* 375 */     node.appendChild(createVariable(doc, "mask", "int", Integer.toString(groleinventory.mask)));
/* 376 */     node.appendChild(doc.createTextNode("\n"));
/* 377 */     node.appendChild(createVariable(doc, "max_count", "int", Integer.toString(groleinventory.max_count)));
/* 378 */     node.appendChild(doc.createTextNode("\n"));
/* 379 */     node.appendChild(createVariable(doc, "pos", "int", Integer.toString(groleinventory.pos)));
/* 380 */     node.appendChild(doc.createTextNode("\n"));
/* 381 */     node.appendChild(createVariable(doc, "proctype", "int", Integer.toString(groleinventory.proctype)));
/* 382 */     node.appendChild(doc.createTextNode("\n"));
/* 383 */     return node;
/*     */   }
/*     */ 
/*     */   private static Node createGRolePocket(Document doc, GRolePocket grolepocket, String nodename) throws Exception {
/* 387 */     Element node = doc.createElement(nodename);
/* 388 */     node.appendChild(doc.createTextNode("\n"));
/* 389 */     node.appendChild(createVariable(doc, "capacity", "int", Integer.toString(grolepocket.capacity)));
/* 390 */     node.appendChild(doc.createTextNode("\n"));
/* 391 */     for (int i = 0; i < grolepocket.items.size(); i++)
/*     */     {
/* 393 */       GRoleInventory groleinventory = (GRoleInventory)grolepocket.items.get(i);
/* 394 */       node.appendChild(createGRoleInventory(doc, groleinventory, "items"));
/*     */     }
/* 396 */     node.appendChild(createVariable(doc, "money", "int", Integer.toString(grolepocket.money)));
/* 397 */     node.appendChild(doc.createTextNode("\n"));
/* 398 */     node.appendChild(createVariable(doc, "reserved1", "int", Integer.toString(grolepocket.reserved1)));
/* 399 */     node.appendChild(doc.createTextNode("\n"));
/* 400 */     node.appendChild(createVariable(doc, "reserved2", "int", Integer.toString(grolepocket.reserved2)));
/* 401 */     node.appendChild(doc.createTextNode("\n"));
/* 402 */     node.appendChild(createVariable(doc, "timestamp", "int", Integer.toString(grolepocket.timestamp)));
/* 403 */     node.appendChild(doc.createTextNode("\n"));
/* 404 */     return node;
/*     */   }
/*     */ 
/*     */   private static Node createGRoleStatus(Document doc, GRoleStatus grolestatus, String nodename) throws Exception {
/* 408 */     Element node = doc.createElement(nodename);
/* 409 */     node.appendChild(doc.createTextNode("\n"));
/* 410 */     node.appendChild(createVariable(doc, "charactermode", "Octets", grolestatus.charactermode));
/* 411 */     node.appendChild(doc.createTextNode("\n"));
/* 412 */     node.appendChild(createVariable(doc, "coolingtime", "Octets", grolestatus.coolingtime));
/* 413 */     node.appendChild(doc.createTextNode("\n"));
/* 414 */     node.appendChild(createVariable(doc, "custom_status", "Octets", grolestatus.custom_status));
/* 415 */     node.appendChild(doc.createTextNode("\n"));
/* 416 */     node.appendChild(createVariable(doc, "dbltime_begin", "int", Integer.toString(grolestatus.dbltime_begin)));
/* 417 */     node.appendChild(doc.createTextNode("\n"));
/* 418 */     node.appendChild(createVariable(doc, "dbltime_data", "Octets", grolestatus.dbltime_data));
/* 419 */     node.appendChild(doc.createTextNode("\n"));
/* 420 */     node.appendChild(createVariable(doc, "dbltime_expire", "int", Integer.toString(grolestatus.dbltime_expire)));
/* 421 */     node.appendChild(doc.createTextNode("\n"));
/* 422 */     node.appendChild(createVariable(doc, "dbltime_max", "int", Integer.toString(grolestatus.dbltime_max)));
/* 423 */     node.appendChild(doc.createTextNode("\n"));
/* 424 */     node.appendChild(createVariable(doc, "dbltime_mode", "int", Integer.toString(grolestatus.dbltime_mode)));
/* 425 */     node.appendChild(doc.createTextNode("\n"));
/* 426 */     node.appendChild(createVariable(doc, "dbltime_used", "int", Integer.toString(grolestatus.dbltime_used)));
/* 427 */     node.appendChild(doc.createTextNode("\n"));
/* 428 */     node.appendChild(createVariable(doc, "exp", "int", Integer.toString(grolestatus.exp)));
/* 429 */     node.appendChild(doc.createTextNode("\n"));
/* 430 */     node.appendChild(createVariable(doc, "faction_contrib", "Octets", grolestatus.faction_contrib));
/* 431 */     node.appendChild(doc.createTextNode("\n"));
/* 432 */     node.appendChild(createVariable(doc, "filter_data", "Octets", grolestatus.filter_data));
/* 433 */     node.appendChild(doc.createTextNode("\n"));
/* 434 */     node.appendChild(createVariable(doc, "force_data", "Octets", grolestatus.force_data));
/* 435 */     node.appendChild(doc.createTextNode("\n"));
/* 436 */     node.appendChild(createVariable(doc, "hp", "int", Integer.toString(grolestatus.hp)));
/* 437 */     node.appendChild(doc.createTextNode("\n"));
/* 438 */     node.appendChild(createVariable(doc, "instancekeylist", "Octets", grolestatus.instancekeylist));
/* 439 */     node.appendChild(doc.createTextNode("\n"));
/* 440 */     node.appendChild(createVariable(doc, "invader_state", "int", Integer.toString(grolestatus.invader_state)));
/* 441 */     node.appendChild(doc.createTextNode("\n"));
/* 442 */     node.appendChild(createVariable(doc, "invader_time", "int", Integer.toString(grolestatus.invader_time)));
/* 443 */     node.appendChild(doc.createTextNode("\n"));
/* 444 */     node.appendChild(createVariable(doc, "level", "int", Integer.toString(grolestatus.level)));
/* 445 */     node.appendChild(doc.createTextNode("\n"));
/* 446 */     node.appendChild(createVariable(doc, "level2", "int", Integer.toString(grolestatus.level2)));
/* 447 */     node.appendChild(doc.createTextNode("\n"));
/* 448 */     node.appendChild(createVariable(doc, "mp", "int", Integer.toString(grolestatus.mp)));
/* 449 */     node.appendChild(doc.createTextNode("\n"));
/* 450 */     node.appendChild(createVariable(doc, "multi_exp_ctrl", "Octets", grolestatus.multi_exp_ctrl));
/* 451 */     node.appendChild(doc.createTextNode("\n"));
/* 452 */     node.appendChild(createVariable(doc, "npc_relation", "Octets", grolestatus.npc_relation));
/* 453 */     node.appendChild(doc.createTextNode("\n"));
/* 454 */     node.appendChild(createVariable(doc, "pariah_time", "int", Integer.toString(grolestatus.pariah_time)));
/* 455 */     node.appendChild(doc.createTextNode("\n"));
/* 456 */     node.appendChild(createVariable(doc, "petcorral", "Octets", grolestatus.petcorral));
/* 457 */     node.appendChild(doc.createTextNode("\n"));
/* 458 */     node.appendChild(createVariable(doc, "posx", "float", Float.toString(grolestatus.posx)));
/* 459 */     node.appendChild(doc.createTextNode("\n"));
/* 460 */     node.appendChild(createVariable(doc, "posy", "float", Float.toString(grolestatus.posy)));
/* 461 */     node.appendChild(doc.createTextNode("\n"));
/* 462 */     node.appendChild(createVariable(doc, "posz", "float", Float.toString(grolestatus.posz)));
/* 463 */     node.appendChild(doc.createTextNode("\n"));
/* 464 */     node.appendChild(createVariable(doc, "pp", "int", Integer.toString(grolestatus.pp)));
/* 465 */     node.appendChild(doc.createTextNode("\n"));
/* 466 */     node.appendChild(createVariable(doc, "property", "Octets", grolestatus.property));
/* 467 */     node.appendChild(doc.createTextNode("\n"));
/* 468 */     node.appendChild(createVariable(doc, "reputation", "int", Integer.toString(grolestatus.reputation)));
/* 469 */     node.appendChild(doc.createTextNode("\n"));
/* 470 */     node.appendChild(createVariable(doc, "reserved31", "byte", Byte.toString(grolestatus.reserved31)));
/* 471 */     node.appendChild(doc.createTextNode("\n"));
/* 472 */     node.appendChild(createVariable(doc, "reserved32", "short", Short.toString(grolestatus.reserved32)));
/* 473 */     node.appendChild(doc.createTextNode("\n"));
/* 474 */     node.appendChild(createVariable(doc, "reserved4", "int", Integer.toString(grolestatus.reserved4)));
/* 475 */     node.appendChild(doc.createTextNode("\n"));
/* 476 */     node.appendChild(createVariable(doc, "reserved5", "int", Integer.toString(grolestatus.reserved5)));
/* 477 */     node.appendChild(doc.createTextNode("\n"));
/* 478 */     node.appendChild(createVariable(doc, "skills", "Octets", grolestatus.skills));
/* 479 */     node.appendChild(doc.createTextNode("\n"));
/* 480 */     node.appendChild(createVariable(doc, "sp", "int", Integer.toString(grolestatus.sp)));
/* 481 */     node.appendChild(doc.createTextNode("\n"));
/* 482 */     node.appendChild(createVariable(doc, "storage_task", "Octets", grolestatus.storage_task));
/* 483 */     node.appendChild(doc.createTextNode("\n"));
/* 484 */     node.appendChild(createVariable(doc, "storehousepasswd", "Octets", grolestatus.storehousepasswd));
/* 485 */     node.appendChild(doc.createTextNode("\n"));
/* 486 */     node.appendChild(createVariable(doc, "storesize", "short", Short.toString(grolestatus.storesize)));
/* 487 */     node.appendChild(doc.createTextNode("\n"));
/* 488 */     node.appendChild(createVariable(doc, "time_used", "int", Integer.toString(grolestatus.time_used)));
/* 489 */     node.appendChild(doc.createTextNode("\n"));
/* 490 */     node.appendChild(createVariable(doc, "var_data", "Octets", grolestatus.var_data));
/* 491 */     node.appendChild(doc.createTextNode("\n"));
/* 492 */     node.appendChild(createVariable(doc, "version", "byte", Byte.toString(grolestatus.version)));
/* 493 */     node.appendChild(doc.createTextNode("\n"));
/* 494 */     node.appendChild(createVariable(doc, "waypointlist", "Octets", grolestatus.waypointlist));
/* 495 */     node.appendChild(doc.createTextNode("\n"));
/* 496 */     node.appendChild(createVariable(doc, "worldtag", "int", Integer.toString(grolestatus.worldtag)));
/* 497 */     node.appendChild(doc.createTextNode("\n"));
/* 498 */     return node;
/*     */   }
/*     */ 
/*     */   private static Node createGRoleStorehouse(Document doc, GRoleStorehouse grolestorehouse, String nodename) throws Exception {
/* 502 */     Element node = doc.createElement(nodename);
/* 503 */     node.appendChild(doc.createTextNode("\n"));
/* 504 */     node.appendChild(createVariable(doc, "capacity", "int", Integer.toString(grolestorehouse.capacity)));
/* 505 */     node.appendChild(doc.createTextNode("\n"));
/* 506 */     for (int i = 0; i < grolestorehouse.dress.size(); i++)
/*     */     {
/* 508 */       GRoleInventory groleinventory = (GRoleInventory)grolestorehouse.dress.get(i);
/* 509 */       node.appendChild(createGRoleInventory(doc, groleinventory, "dress"));
/*     */     }
/* 511 */     for (int i = 0; i < grolestorehouse.items.size(); i++)
/*     */     {
/* 513 */       GRoleInventory groleinventory = (GRoleInventory)grolestorehouse.items.get(i);
/* 514 */       node.appendChild(createGRoleInventory(doc, groleinventory, "items"));
/*     */     }
/* 516 */     for (int i = 0; i < grolestorehouse.material.size(); i++)
/*     */     {
/* 518 */       GRoleInventory groleinventory = (GRoleInventory)grolestorehouse.material.get(i);
/* 519 */       node.appendChild(createGRoleInventory(doc, groleinventory, "material"));
/*     */     }
/* 521 */     node.appendChild(createVariable(doc, "money", "int", Integer.toString(grolestorehouse.money)));
/* 522 */     node.appendChild(doc.createTextNode("\n"));
/* 523 */     node.appendChild(createVariable(doc, "reserved", "int", Integer.toString(grolestorehouse.reserved)));
/* 524 */     node.appendChild(doc.createTextNode("\n"));
/* 525 */     node.appendChild(createVariable(doc, "size1", "byte", Byte.toString(grolestorehouse.size1)));
/* 526 */     node.appendChild(doc.createTextNode("\n"));
/* 527 */     node.appendChild(createVariable(doc, "size2", "byte", Byte.toString(grolestorehouse.size2)));
/* 528 */     node.appendChild(doc.createTextNode("\n"));
/* 529 */     return node;
/*     */   }
/*     */ 
/*     */   private static Node createGRoleTask(Document doc, GRoleTask groletask, String nodename) throws Exception {
/* 533 */     Element node = doc.createElement(nodename);
/* 534 */     node.appendChild(doc.createTextNode("\n"));
/* 535 */     node.appendChild(createVariable(doc, "task_complete", "Octets", groletask.task_complete));
/* 536 */     node.appendChild(doc.createTextNode("\n"));
/* 537 */     node.appendChild(createVariable(doc, "task_data", "Octets", groletask.task_data));
/* 538 */     node.appendChild(doc.createTextNode("\n"));
/* 539 */     node.appendChild(createVariable(doc, "task_finishtime", "Octets", groletask.task_finishtime));
/* 540 */     node.appendChild(doc.createTextNode("\n"));
/* 541 */     for (int i = 0; i < groletask.task_inventory.size(); i++)
/*     */     {
/* 543 */       GRoleInventory groleinventory = (GRoleInventory)groletask.task_inventory.get(i);
/* 544 */       node.appendChild(createGRoleInventory(doc, groleinventory, "task_inventory"));
/*     */     }
/* 546 */     return node;
/*     */   }
/*     */ 
/*     */   public static Role getRoleFromDB(int roleid) throws InterruptedException, Exception
/*     */   {
/* 551 */     GRoleData groledata = GameDB.getRoleData(roleid);
/* 552 */     if (null == groledata) return null;
/* 553 */     Role role = new Role();
/* 554 */     role.base = groledata.base;
/* 555 */     role.equipment = groledata.equipment;
/* 556 */     role.pocket = groledata.pocket;
/* 557 */     role.status = groledata.status;
/* 558 */     role.storehouse = groledata.storehouse;
/* 559 */     role.task = groledata.task;
/* 560 */     if ((null == role.base) || (null == role.status))
/* 561 */       return null;
/* 562 */     return role;
/*     */   }
/*     */ 
/*     */   public static boolean putRoleToDB(int roleid, Role role) throws InterruptedException, Exception
/*     */   {
/* 567 */     GRoleData groledata = new GRoleData();
/* 568 */     groledata.base = role.base;
/* 569 */     groledata.equipment = role.equipment;
/* 570 */     groledata.pocket = role.pocket;
/* 571 */     groledata.status = role.status;
/* 572 */     groledata.storehouse = role.storehouse;
/* 573 */     groledata.task = role.task;
/* 574 */     return GameDB.putRoleData(roleid, groledata);
/*     */   }
/*     */ 
/*     */   public static Document toXML(Role role) throws ParserConfigurationException, Exception
/*     */   {
/* 579 */     Document doc = DocumentBuilderFactory.newInstance().newDocumentBuilder().newDocument();
/* 580 */     Element root = doc.createElement("role");
/* 581 */     root.appendChild(doc.createTextNode("\n"));
/* 582 */     root.appendChild(doc.createTextNode("\n"));
/* 583 */     root.appendChild(createGRoleBase(doc, role.base, "base"));
/* 584 */     root.appendChild(doc.createTextNode("\n"));
/* 585 */     root.appendChild(doc.createTextNode("\n"));
/* 586 */     root.appendChild(createGRoleEquipment(doc, role.equipment, "equipment"));
/* 587 */     root.appendChild(doc.createTextNode("\n"));
/* 588 */     root.appendChild(doc.createTextNode("\n"));
/* 589 */     root.appendChild(createGRolePocket(doc, role.pocket, "pocket"));
/* 590 */     root.appendChild(doc.createTextNode("\n"));
/* 591 */     root.appendChild(doc.createTextNode("\n"));
/* 592 */     root.appendChild(createGRoleStatus(doc, role.status, "status"));
/* 593 */     root.appendChild(doc.createTextNode("\n"));
/* 594 */     root.appendChild(doc.createTextNode("\n"));
/* 595 */     root.appendChild(createGRoleStorehouse(doc, role.storehouse, "storehouse"));
/* 596 */     root.appendChild(doc.createTextNode("\n"));
/* 597 */     root.appendChild(doc.createTextNode("\n"));
/* 598 */     root.appendChild(createGRoleTask(doc, role.task, "task"));
/* 599 */     root.appendChild(doc.createTextNode("\n"));
/* 600 */     doc.appendChild(root);
/* 601 */     root.appendChild(doc.createTextNode("\n"));
/* 602 */     return doc;
/*     */   }
/*     */ 
/*     */   public static void main(String[] args) throws Exception
/*     */   {
/* 607 */     test();
/*     */   }
/*     */ 
/*     */   public static void reverse() throws Exception {
/* 611 */     File file1 = new File("role.txt");
/* 612 */     File file2 = new File("role2.txt");
/* 613 */     Role role2 = fromXML(file1);
/* 614 */     toXMLFile(role2, file2);
/*     */   }
/*     */ 
/*     */   public static void gen() throws Exception {
/* 618 */     Role role = new Role();
/* 619 */     File file = new File("role.txt");
/* 620 */     role.base = new GRoleBase();
/* 621 */     role.base.config_data = new Octets();
/* 622 */     role.base.custom_data = new Octets();
/* 623 */     role.base.forbid.add(new GRoleForbid());
/* 624 */     role.base.help_states = new Octets();
/* 625 */     role.base.name = new Octets();
/* 626 */     role.equipment = new GRoleEquipment();
/* 627 */     role.equipment.inv.add(new GRoleInventory());
/* 628 */     role.pocket = new GRolePocket();
/* 629 */     role.pocket.items.add(new GRoleInventory());
/* 630 */     role.status = new GRoleStatus();
/* 631 */     role.status.charactermode = new Octets();
/* 632 */     role.status.coolingtime = new Octets();
/* 633 */     role.status.custom_status = new Octets();
/* 634 */     role.status.dbltime_data = new Octets();
/* 635 */     role.status.faction_contrib = new Octets();
/* 636 */     role.status.filter_data = new Octets();
/* 637 */     role.status.force_data = new Octets();
/* 638 */     role.status.instancekeylist = new Octets();
/* 639 */     role.status.multi_exp_ctrl = new Octets();
/* 640 */     role.status.npc_relation = new Octets();
/* 641 */     role.status.petcorral = new Octets();
/* 642 */     role.status.property = new Octets();
/* 643 */     role.status.skills = new Octets();
/* 644 */     role.status.storage_task = new Octets();
/* 645 */     role.status.storehousepasswd = new Octets();
/* 646 */     role.status.var_data = new Octets();
/* 647 */     role.status.waypointlist = new Octets();
/* 648 */     role.storehouse = new GRoleStorehouse();
/* 649 */     role.storehouse.dress.add(new GRoleInventory());
/* 650 */     role.storehouse.items.add(new GRoleInventory());
/* 651 */     role.storehouse.material.add(new GRoleInventory());
/* 652 */     role.task = new GRoleTask();
/* 653 */     role.task.task_complete = new Octets();
/* 654 */     role.task.task_data = new Octets();
/* 655 */     role.task.task_finishtime = new Octets();
/* 656 */     role.task.task_inventory.add(new GRoleInventory());
/* 657 */     toXMLFile(role, file);
/*     */   }
/*     */   public static void test() throws Exception {
/* 660 */     File file = new File("/home/lijinhua2/repos/iweb/test/133466784.xml");
/* 661 */     Role role = fromXML(file);
/* 662 */     File file2 = new File("/home/lijinhua2/repos/iweb/test/133466784.2.xml");
/* 663 */     toXMLFile(role, file2);
/*     */   }
/*     */ 
/*     */   public static class Role
/*     */   {
/*     */     public GRoleBase base;
/*     */     public GRoleEquipment equipment;
/*     */     public GRolePocket pocket;
/*     */     public GRoleStatus status;
/*     */     public GRoleStorehouse storehouse;
/*     */     public GRoleTask task;
/*     */   }
/*     */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.XmlRole
 * JD-Core Version:    0.6.2
 */
/*     */ package protocol;
/*     */ 
/*     */ import com.goldhuman.Common.Octets;
/*     */ import java.io.PrintStream;
/*     */ import org.w3c.dom.Document;
/*     */ import org.w3c.dom.Element;
/*     */ import org.w3c.dom.Node;
/*     */ import org.w3c.dom.NodeList;
/*     */ import org.w3c.dom.Text;
/*     */ 
/*     */ public class XmlRoleBase
/*     */ {
/*     */   protected static String toHexString(byte[] x)
/*     */   {
/*  29 */     StringBuffer sb = new StringBuffer(x.length * 2);
/*  30 */     for (int i = 0; i < x.length; i++)
/*     */     {
/*  32 */       byte n = x[i];
/*  33 */       int nibble = n >> 4 & 0xF;
/*  34 */       sb.append((char)(nibble >= 10 ? 97 + nibble - 10 : 48 + nibble));
/*  35 */       nibble = n & 0xF;
/*  36 */       sb.append((char)(nibble >= 10 ? 97 + nibble - 10 : 48 + nibble));
/*     */     }
/*  38 */     return sb.toString();
/*     */   }
/*     */ 
/*     */   protected static byte[] hextoByteArray(String x)
/*     */   {
/*  43 */     if (x.length() < 2)
/*  44 */       return new byte[0];
/*  45 */     if (x.length() % 2 != 0) {
/*  46 */       System.err.println("hextoByteArray error! hex size=" + Integer.toString(x.length()));
/*     */     }
/*  48 */     byte[] rb = new byte[x.length() / 2];
/*  49 */     for (int i = 0; i < rb.length; i++)
/*     */     {
/*  51 */       rb[i] = 0;
/*     */ 
/*  53 */       int n = x.charAt(i + i);
/*  54 */       if ((n >= 48) && (n <= 57))
/*  55 */         n -= 48;
/*  56 */       else if ((n >= 97) && (n <= 102))
/*  57 */         n = n - 97 + 10;
/*  58 */       rb[i] = ((byte)(rb[i] | n << 4 & 0xF0));
/*     */ 
/*  60 */       n = x.charAt(i + i + 1);
/*  61 */       if ((n >= 48) && (n <= 57))
/*  62 */         n -= 48;
/*  63 */       else if ((n >= 97) && (n <= 102))
/*  64 */         n = n - 97 + 10;
/*  65 */       rb[i] = ((byte)(rb[i] | n & 0xF));
/*     */     }
/*  67 */     return rb;
/*     */   }
/*     */ 
/*     */   protected static String escapeUnprintable(String x)
/*     */   {
/*  73 */     StringBuilder sb = new StringBuilder();
/*  74 */     for (int i = 0; i < x.length(); i++)
/*     */     {
/*  76 */       if ((byte)x.charAt(i) == 7)
/*     */       {
/*  78 */         sb.append("#########7;");
/*     */       }
/*     */       else
/*  81 */         sb.append(x.charAt(i));
/*     */     }
/*  83 */     return sb.toString();
/*     */   }
/*     */ 
/*     */   protected static String unescapeUnprintable(String x)
/*     */   {
/*  88 */     String match = "#########7;";
/*  89 */     if (x.indexOf(match) >= 0)
/*     */     {
/*  91 */       byte[] rb = new byte[1];
/*  92 */       rb[0] = 7;
/*  93 */       x = x.replace(match, new String(rb));
/*     */     }
/*  95 */     return x;
/*     */   }
/*     */ 
/*     */   protected static Node createVariable(Document doc, String name, String type, String value)
/*     */   {
/* 101 */     Element var = doc.createElement("variable");
/* 102 */     var.setAttribute("name", name);
/* 103 */     var.setAttribute("type", type);
/* 104 */     var.appendChild(doc.createTextNode(value));
/* 105 */     return var;
/*     */   }
/*     */ 
/*     */   protected static Node createVariable(Document doc, String name, String type, Octets value)
/*     */   {
/* 110 */     Element var = doc.createElement("variable");
/* 111 */     var.setAttribute("name", name);
/* 112 */     var.setAttribute("type", type);
/* 113 */     var.appendChild(doc.createTextNode(toHexString(value.getBytes())));
/* 114 */     return var;
/*     */   }
/*     */ 
/*     */   protected static String getElementValue(NodeList list, String name) throws XmlRoleBase.XmlRoleException
/*     */   {
/* 119 */     for (int i = 0; i < list.getLength(); i++)
/*     */     {
/* 121 */       Element node = (Element)list.item(i);
/* 122 */       String n = node.getAttribute("name");
/* 123 */       if (name.equals(n))
/*     */       {
/* 125 */         Text child = (Text)node.getFirstChild();
/* 126 */         if (null == child)
/* 127 */           return "";
/* 128 */         return child.getNodeValue();
/*     */       }
/*     */     }
/* 131 */     throw new XmlRoleException("getElementValue(NodeList,String): list.size=" + list.getLength() + ", name=" + name);
/*     */   }
/*     */ 
/*     */   protected static String getElementValue(NodeList list, String name, String parentName) throws XmlRoleBase.XmlRoleException
/*     */   {
/* 136 */     for (int i = 0; i < list.getLength(); i++)
/*     */     {
/* 138 */       Element node = (Element)list.item(i);
/* 139 */       if (node.getParentNode().getNodeName().equals(parentName)) {
/* 140 */         String n = node.getAttribute("name");
/* 141 */         if (name.equals(n))
/*     */         {
/* 143 */           Text child = (Text)node.getFirstChild();
/* 144 */           if (null == child)
/* 145 */             return "";
/* 146 */           return child.getNodeValue();
/*     */         }
/*     */       }
/*     */     }
/* 149 */     throw new XmlRoleException("getElementValue(NodeList,String, parentName): list.size=" + list.getLength() + ", name=" + name + ",parentName=" + parentName);
/*     */   }
/*     */ 
/*     */   public static class XmlRoleException extends Exception
/*     */   {
/*     */     public XmlRoleException(String s)
/*     */     {
/*  23 */       super();
/*     */     }
/*     */   }
/*     */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.XmlRoleBase
 * JD-Core Version:    0.6.2
 */
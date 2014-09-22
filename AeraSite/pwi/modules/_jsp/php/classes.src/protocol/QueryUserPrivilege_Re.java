/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Manager;
/*    */ import com.goldhuman.IO.Protocol.Protocol;
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data.DataVector;
/*    */ import com.goldhuman.IO.Protocol.Session;
/*    */ 
/*    */ public final class QueryUserPrivilege_Re extends Protocol
/*    */ {
/*    */   public int userid;
/*    */   public Rpc.Data.DataVector auth;
/*    */ 
/*    */   public QueryUserPrivilege_Re()
/*    */   {
/* 17 */     this.auth = new Rpc.Data.DataVector(new ByteData());
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 55 */     os.marshal(this.userid);
/* 56 */     os.marshal(this.auth);
/* 57 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 62 */     this.userid = os.unmarshal_int();
/* 63 */     os.unmarshal(this.auth);
/* 64 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 71 */       QueryUserPrivilege_Re o = (QueryUserPrivilege_Re)super.clone();
/* 72 */       o.auth = ((Rpc.Data.DataVector)this.auth.clone());
/* 73 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 76 */     return null;
/*    */   }
/*    */ 
/*    */   public void Process(Manager manager, Session session)
/*    */     throws ProtocolException
/*    */   {
/*    */   }
/*    */ 
/*    */   public final class ByteData extends Rpc.Data
/*    */   {
/*    */     public byte b;
/*    */ 
/*    */     public ByteData()
/*    */     {
/*    */     }
/*    */ 
/*    */     public OctetsStream marshal(OctetsStream os)
/*    */     {
/* 30 */       os.marshal(this.b);
/* 31 */       return os;
/*    */     }
/*    */ 
/*    */     public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */     {
/* 36 */       this.b = os.unmarshal_byte();
/* 37 */       return os;
/*    */     }
/*    */ 
/*    */     public Object clone()
/*    */     {
/*    */       try
/*    */       {
/* 44 */         return (ByteData)super.clone();
/*    */       }
/*    */       catch (Exception e) {
/*    */       }
/* 48 */       return null;
/*    */     }
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.QueryUserPrivilege_Re
 * JD-Core Version:    0.6.2
 */